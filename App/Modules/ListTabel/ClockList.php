<?php
namespace TAI\App\Modules\ListTabel;

use WP_List_Table;

(defined('ABSPATH')) || exit;

if (! class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class ClockList extends WP_List_Table
{

    public function get_columns()
    {
        return [
            'title'     => 'عنوان',
            'date'      => 'تاریخ',
            'time'      => 'ساعت',
            'diff_time' => 'زمان باقیمانده',
         ];
    }

    public function column_title($item)
    {
        $csrf = wp_create_nonce(config('app.key') . '_clock_' . $item[ 'id' ] . get_current_user_id());

        $action = [
            'delete' => sprintf('<a onclick="return confirm(\'%s\')" href="%s">%s</a>', 'آیا مایل به حذف این ساعت هستید؟', admin_url('admin.php?page=clocks-menu&clockid=' . $item[ 'id' ] . '&delete&_wpnonce=' . $csrf), 'حذف'),

         ];

        return ($item[ 'title' ] ?? '') . $this->row_actions($action);

    }
    public function column_diff_time($item)
    {

        return diff_time($item[ 'id' ]);

    }

    // public function column_ID($item)
    // {

    //     return $item[ 'ID' ] . '-' . time() . '=' . ($item[ 'ID' ] - time());

    // }

    public function column_default($item, $column_name)
    {
        if (isset($item[ $column_name ])) {
            return wp_kses($item[ $column_name ], [
                'span' => [  ],
             ]);
        }
        return '-';
    }

    public function prepare_items()
    {
        $results = get_option('tai_clock', [  ]);

        foreach ($results[ 'clocks' ] ?? [  ] as $key => $value) {
            if (intval($key) + ($clock_option[ 'setting' ][ 'time_stamp' ] ?? 0) <= time()) {
                unset($results[ 'clocks' ][ $key ]);
            }
        }

        $this->_column_headers = [
            $this->get_columns(),
            [  ],
            [  ],
            'title',
         ];

        $this->items = $results[ 'clocks' ] ?? [  ];

    }

}
