<?php
namespace TAI\App\Modules\ListTabel;

use TAI\App\Core\Table;
use TAI\App\Models\Gifts;

(defined('ABSPATH')) || exit;

class GiftsList extends Table
{

    public function __construct()
    {
        parent::__construct([
            'singular' => 'gift',
            'plural'   => 'gifts',
            'ajax'     => false,
         ]);
    }

    public function get_table_classes()
    {
        return [ 'widefat', 'fixed', 'striped', $this->_args[ 'plural' ] ];
    }

    private $par_page = 20;
    private $m;

    public function get_columns()
    {
        return [
            'row'   => 'ردیف',
            'title' => 'عنوان',
            'image' => 'تصویر',

         ];
    }

    public function column_default($item, $column_name)
    {

        if (isset($item[ $column_name ])) {
            return wp_kses($item[ $column_name ], [
                'span' => [  ],
             ]);
        }
        return '-';
    }

    public function column_row($item)
    {
        $this->m++;
        return $this->m;
    }

    public function column_title($item)
    {
        $csrf = wp_create_nonce(config('app.key') . '_clock_' . $item[ 'id' ] . get_current_user_id());

        $action = [
            'edit'   => '<a href="' . admin_url('edit.php?post_type=content_ayeh&page=gifts&id=' . $item[ 'id' ] . '&edit&_wpnonce=' . $csrf) . '">ویرایش</a>',
            'delete' => sprintf('<a onclick="return confirm(\'%s\')" href="%s">%s</a>', 'آیا مایل به حذف این ساعت هستید؟', admin_url('edit.php?post_type=content_ayeh&page=gifts&id=' . $item[ 'id' ] . '&delete&_wpnonce=' . $csrf), 'حذف'),
         ];

        return ($item[ 'title' ] ?? '') . $this->row_actions($action);

    }

    public function column_image($item)
    {
        $image_url =  get_the_image_url_by_id($item[ 'image_id' ]);
        return '<img src="' . $image_url . '" style="height: 75px;" >';
    }

    public function no_items()
    {
        echo 'ایتمی یافت نشد';
    }

    public function prepare_items()
    {

        $this->process_bulk_action();
        $this->_column_headers = [
            $this->get_columns(),
            [  ],
            $this->get_sortabele_colums(),
            'title',
         ];

        $offset = isset($_GET[ 'paged' ]) ? (absint($_GET[ 'paged' ]) - 1) : 0;

        $search = isset($_REQUEST[ 's' ]) ? sanitize_text_field($_REQUEST[ 's' ]) : '';

        $sites = Gifts::all()
            ->orderBy('id', 'DESC');

        if (! empty($search)) {
            $sites = $sites->where('title', 'LIKE', "%{$search}%");
        }

        $this->set_pagination_args([
            'total_items' => $sites->count(),
            'per_page'    => $this->par_page,
         ]);

        $this->items = $sites
            ->limit($this->par_page, $offset)
            ->toArray();

    }

}
