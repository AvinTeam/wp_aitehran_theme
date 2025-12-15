<?php
namespace TAI\App\Core\DB;

use TAI\App\Core\DB\DB;

( defined( 'ABSPATH' ) ) || exit;

abstract class Model extends DB {

    protected $attributes        = array();
    protected $fillable          = array();
    protected $exists            = false;
    protected static $relations  = array();
    protected string $primaryKey = 'id';
    protected array $pivotHidden = array();
    protected array $appenders   = array();

    public function __construct( array $attributes = array() ) {

        if ( isset( $attributes[ 'isAll' ] ) ) {
            $this->isAll = true;
        }

        parent::__construct();
        $this->fill( $attributes );
        $table = $this->table ?? self::generateTable();
        $this->setTable( $table );
    }

    public static function generateTable( string $table = "" ): string {

        if ( empty( $table ) ) {
            $table = basename( str_replace( '\\', '/', get_called_class() ) );
            $table = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $table ) );
        }

        return config( 'app.key' ) . $table;
    }

    public function getKeyName(): string {
        return $this->primaryKey;
    }

    public function getPivotHidden(): array {
        return $this->pivotHidden;
    }

    public static function all(): QueryBuilder {
        $instance = new static( array(
            'isAll' => true,
        ) );
        return new QueryBuilder( $instance );
    }

    public static function find( int $id, string $selector = null ): ?static
    {
        $instance = new static();

        $pk   = $instance->getKeyName();
        $data = $instance->db_get( array( $pk => $id ) );

        if ( ! $data ) {
            return null;
        }

        $instance->fill( (array) $data );
        $instance->exists = true;

        $instance->attributes[ 'id' ] = $data->$pk;

        return $instance;
    }

    public static function customFind( string $key, string $value ): ?static
    {
        $instance = new static();

        $pk   = $instance->getKeyName();
        $data = $instance->db_get( array( $key => $value ) );

        if ( ! $data ) {
            return null;
        }

        $instance->fill( (array) $data );
        $instance->exists = true;

        $instance->attributes[ 'id' ] = $data->$pk;

        return $instance;
    }

    public static function create( array $attributes ): static
    {
        $model = new static( $attributes );
        $model->save();
        return $model;
    }

    public function update( array $attributes ): bool {
        $this->fill( $attributes );
        return $this->save();
    }

    public function delete(): bool {

        if ( ! $this->exists || ! isset( $this->attributes[ 'id' ] ) ) {
            return false;
        }

        $result = parent::db_delete( array( 'id' => $this->attributes[ 'id' ] ) );

        if ( $result ) {
            $this->exists     = false;
            $this->attributes = array();
        }

        return $result;
    }

    public function refresh(): static
    {

        if ( $this->exists && isset( $this->attributes[ 'id' ] ) ) {
            $freshData = $this->db_get( array( 'id' => $this->attributes[ 'id' ] ) );

            if ( $freshData ) {
                $this->attributes = (array) $freshData;
            }
        }

        return $this;
    }

    public function save(): bool {
        $data = array_intersect_key( $this->attributes, array_flip( $this->fillable ) );

        if ( $this->exists && isset( $this->attributes[ 'id' ] ) ) {
            $result = parent::db_update( $data, array( 'id' => $this->attributes[ 'id' ] ) );
            return (bool) $result;
        }

        $id = parent::db_insert( $data );

        if ( $id ) {
            $this->attributes[ 'id' ] = $id;
            $this->exists             = true;
            return true;
        }

        return false;
    }

    public function newInstance( array $attributes, bool $exists = false ): static
    {
        $model         = new static( $attributes );
        $model->exists = $exists;
        return $model;
    }

    public function toArray(): array {

        return $this->attributes;
    }

    protected function fill( array $attributes ): void {

        foreach ( $attributes as $key => $value ) {
            if ( in_array( $key, $this->fillable ) ) {
                $this->attributes[ $key ] = $value;
            }
        }
    }

    public function getAttributes(): array {
        return $this->attributes;
    }

    public function __set( string $name, $value ): void {

        if ( in_array( $name, $this->fillable ) ) {
            $this->attributes[ $name ] = $value;
        }
    }

    public function __get( string $name ) {

        if ( 'id' === $name ) {
            $pk = $this->getKeyName();
            return $this->attributes[ 'id' ] ?? ( $this->attributes[ $pk ] ?? null );
        }

        if ( in_array( $name, $this->fillable ) ) {
            return $this->attributes[ $name ] ?? null;
        }

        if ( isset( static::$relations[ $name ] ) ) {
            return static::$relations[ $name ];
        }

        throw new \Exception( "Property {$name} does not exist on " . get_class( $this ) );
    }

    public function __isset( string $name ): bool {
        return array_key_exists( $name, $this->attributes ) || isset( static::$relations[ $name ] );
    }

    public function __call( $method, $parameters ) {

        if ( isset( static::$relations[ $method ] ) ) {
            return static::$relations[ $method ];
        }

        throw new \BadMethodCallException( sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ) );
    }

    public function getTableName(): string {

        if ( ! isset( $this->table ) ) {
            $table       = basename( str_replace( '\\', '/', get_called_class() ) );
            $this->table = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $table ) );
        }

        return $this->table;
    }

    public function hasMany( string $relatedClass, string $foreignKey, string $localKey = 'id' ): QueryBuilder {
        $related = new $relatedClass();
        $query   = new QueryBuilder( $related );

        $query->where( $foreignKey, $this->$localKey );

        return $query;
    }

    public function belongsToMany(
        string $relatedClass,
        string $pivotTable,
        string $foreignPivotKey,
        string $relatedPivotKey,
        string $localKey = 'id'
    ): QueryBuilder {
        $related = new $relatedClass();

        $db = new DB();
        $db->setTable( self::generateTable( $pivotTable ) );

        $pivotRows = $db->db_select( array(
            'data'  => array(),
            'where' => "{$foreignPivotKey} = {$this->$localKey}",
        ) );

        $ids = array_map( fn( $row ) => $row->$relatedPivotKey, (array) $pivotRows );

        $query = new QueryBuilder( $related );

        if ( ! empty( $ids ) ) {
            $query->whereIn( $related->getKeyName(), $ids );
        }

        $pivotFullName = $db->getTable();
        $query->join( $pivotFullName, "{$pivotFullName}.{$relatedPivotKey}", "=", $related->getTableName() . "." . $related->getKeyName() )
            ->where( "{$pivotFullName}.{$foreignPivotKey}", '=', $this->$localKey );

        $query->setPivotData( $pivotRows )
            ->setRelatedPivotKey( $relatedPivotKey );

        return $query;
    }

    public function getAppender( string $key ):  ? callable
    {

        if ( isset( $this->appenders[ $key ] ) ) {
            return $this->appenders[ $key ];
        }

        if ( method_exists( $this, 'appenders' ) ) {
            $all = $this->appenders();
            return $all[ $key ] ?? null;
        }

        return null;
    }
}
