<?php
namespace TAI\App\Modules\Taxonomies;

use TAI\App\Core\Taxonomies;

( defined( 'ABSPATH' ) ) || exit;

class FormatArtTaxonomies extends Taxonomies {

    public function __construct() {
        // add_action( 'init', array( $this, 'register' ) );
    }

    public function register() {
        $labels = array(
            'name'                  => 'قالب ها',
            'singular_name'         => 'قالب ها',
            'search_items'          => 'جست و جو قالب ها',
            'popular_items'         => 'قالب ها محبوب',
            'all_items'             => 'قالب ها',
            'edit_item'             => 'ویرایش قالب',
            'update_item'           => 'بروزرسانی قالب',
            'add_new_item'          => 'افزودن قالب',
            'new_item_name'         => 'نام قالب جدید',
            'add_or_remove_items'   => 'اضافه کردن یا حذف قالب',
            'choose_from_most_used' => 'از میان قالب ها پرکاربرد انتخاب کنید',
            'not_found'             => 'قالبی را یافت نشد',
            'menu_name'             => 'قالب ها',
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'public'            => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'format_art' ),
        );

        register_taxonomy( 'format_art', 'matart', $args );
    }

}
