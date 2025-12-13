<?php
namespace TAI\App\Core;

if (! class_exists('WP_List_Table')) {

    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

}

use WP_List_Table;

(defined('ABSPATH')) || exit;

class Table extends WP_List_Table
{

}
