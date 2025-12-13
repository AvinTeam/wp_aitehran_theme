<?php
namespace TAI\App\Core\DB;

(defined('ABSPATH')) || exit;

class QueryBuilder
{
    protected Model $model;
    protected array $wheres            = [  ];
    protected ?int $limit              = null;
    protected ?int $offset             = null;
    protected ?array $order            = null;
    protected array $pivotRows         = [  ];
    protected array $pivotData         = [  ];
    protected ?string $relatedPivotKey = null;
    protected array $appends           = [  ];
    protected array $joins             = [  ];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function append(string | array $keys): static
    {
        if (is_string($keys)) {
            $this->appends[  ] = $keys;
        } else {
            $this->appends = array_merge($this->appends, $keys);
        }
        return $this;
    }

    protected function applyAppends(array &$rows): void
    {
        if (empty($this->appends)) {
            return;
        }

        foreach ($rows as &$row) {
            foreach ($this->appends as $key) {
                $callback = $this->model->getAppender($key);

                if (is_callable($callback)) {
                    $row[ $key ] = $callback($row);
                } else {
                    $row[ $key ] = null;
                }
            }
        }
    }

    public function join(string $table, string $first, string $operator, string $second, string $type = 'INNER'): static
    {
        $this->joins[  ] = strtoupper($type) . " JOIN {$table} ON {$first} {$operator} {$second}";
        return $this;
    }

    public function leftJoin(string $table, string $first, string $operator, string $second): static
    {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function rightJoin(string $table, string $first, string $operator, string $second): static
    {
        return $this->join($table, $first, $operator, $second, 'RIGHT');
    }

    public function where(string $column, $operator, $value = null): static
    {
        $this->whereArray($column, $operator, $value);
        return $this;
    }

    public function orWhere(string $column, $operator, $value = null): static
    {
        $this->whereArray($column, $operator, $value, "OR");
        return $this;
    }

    public function when($condition, callable $callback): static
    {
        if ($condition) {
            $callback($this);
        }
        return $this;
    }

    public function limit(int $limit, int $offset = 0): static
    {
        $this->limit  = $limit;
        $this->offset = $offset;
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): static
    {
        $this->order = [ 'column' => $column, 'direction' => $direction ];
        return $this;
    }

    public function get(): array
    {
        $table = $this->model->getTableName();
        $query = "SELECT {$table}.* FROM {$table}";
        if (! empty($this->joins)) {
            $query .= ' ' . implode(' ', $this->joins);
        }
        $where = $this->buildWhereRaw();
        if ($where) {
            $query .= " WHERE {$where}";
        }

        if ($this->order) {
            $query .= " ORDER BY `{$this->order[ 'column' ]}` {$this->order[ 'direction' ]}";
        }

        if ($this->limit !== null) {
            $query .= " LIMIT {$this->offset}, {$this->limit}";
        }

        $this->model->query = $query;
        $results            = $this->model->get_results($query);
        return array_map(fn($item) => $this->model->newInstance((array) $item, true), $results);
    }

    public function setRelatedPivotKey(string $key): static
    {
        $this->relatedPivotKey = $key;
        return $this;
    }

    public function toArray(): array
    {
        $rows = $this->get();

        $rows = array_map(function ($row) {
            return ($row instanceof Model) ? $row->getAttributes() : (array) $row;
        }, $rows);

        if ($this->pivotData) {
            $pivotById = [  ];

            foreach ($this->pivotData as $pivot) {
                $pivotArr = (array) $pivot;

                foreach (array_keys($pivotArr) as $k) {
                    if (str_ends_with($k, '_id')) {
                        unset($pivotArr[ $k ]);
                    }
                }

                if ($this->relatedPivotKey && isset($pivot->{$this->relatedPivotKey})) {
                    $pivotById[ $pivot->{$this->relatedPivotKey} ] = $pivotArr;
                }
            }

            $primaryKey = $this->model->getKeyName();

            $rows = array_map(function ($rowArr) use ($pivotById, $primaryKey) {
                if (isset($rowArr[ $primaryKey ], $pivotById[ $rowArr[ $primaryKey ] ])) {
                    $rowArr = array_merge($rowArr, $pivotById[ $rowArr[ $primaryKey ] ]);
                }
                return $rowArr;
            }, $rows);
        }

        $this->applyAppends($rows);
        return $rows;
    }

    public function count(): int
    {
        $table = $this->model->getTableName();
        $query = "SELECT COUNT(*) FROM {$table}";
        if (! empty($this->joins)) {
            $query .= ' ' . implode(' ', $this->joins);
        }
        $where = $this->buildWhereRaw();
        if ($where) {
            $query .= " WHERE {$where}";
        }

        $this->model->query = $query;
        return (int) $this->model->get_var($query);
    }

    public function whereIn(string $column, array $values): static
    {
        $this->whereArray($column, 'IN', $values);
        return $this;
    }

    private function quoteIdentifier(string $col): string
    {
        if ($col === '*' || preg_match('/\(|\)|\s/', $col)) {
            return $col;
        }

        if (str_contains($col, '.')) {
            [ $t, $c ] = explode('.', $col, 2);
            return "`{$t}`.`{$c}`";
        }
        return "`{$col}`";
    }

    protected function buildWhereRaw(): string
    {
        $clauses = [  ];
        foreach ($this->wheres as [ $column, $operator, $value, $type ]) {
            if ($operator === '') {$clauses[  ] = $column;
                continue;}

            if (is_array($value) || is_object($value)) {
                $value = '(' . implode(',', $value) . ')';
            } elseif (is_numeric($value)) {
                $value = (string) intval($value);
            } else {
                $value = (string) $value;
            }

            $prefix      = count($clauses) ? $type . ' ' : '';
            $col         = $this->quoteIdentifier($column);
            $clauses[  ] = "{$prefix}{$col} {$operator} {$value}";
        }
        return implode(' ', $clauses);
    }

    public function setPivotRows(array $pivotRows, string $relatedPivotKey): static
    {
        $this->pivotRows       = $pivotRows;
        $this->relatedPivotKey = $relatedPivotKey;
        return $this;
    }

    public function setPivotData(array $pivotData)
    {
        $this->pivotData = $pivotData;
        return $this;
    }

    public function getPivotData()
    {
        return $this->pivotData;
    }

    private function whereArray($column, $operator, $value, $type = "AND")
    {

        if ($value === null) {
            $value    = $operator;
            $operator = '=';
        }
        if (is_numeric($value)) {
            $value = intval($value);
        } elseif (is_string($value)) {
            $value = "'$value'";
        }

        $this->wheres[  ] = [ $column, $operator, $value, $type ];
    }

    public function pivotWhere(string $column, string $operator, $value = null): self
    {
        if ($value === null) {
            $value    = $operator;
            $operator = '=';
        }

        if ($this->pivotData) {
            $filtered = array_filter($this->pivotData, function ($row) use ($column, $operator, $value) {
                $fieldValue = $row->$column;
                return match ($operator) {
                    '='     => $fieldValue == $value,
                    '!='    => $fieldValue != $value,
                    '>'     => $fieldValue > $value,
                    '<'     => $fieldValue < $value,
                    '>='    => $fieldValue >= $value,
                    '<='    => $fieldValue <= $value,
                    'LIKE'  => stripos($fieldValue, str_replace('%', '', $value)) !== false,
                    default => throw new \InvalidArgumentException("Unsupported operator: $operator"),
                };
            });

            $this->pivotData = $filtered;

            $ids = array_map(fn($row) => $row->{$this->relatedPivotKey}, $filtered);
            $this->whereIn($this->model->getKeyName(), $ids);
        }

        return $this;
    }

}
