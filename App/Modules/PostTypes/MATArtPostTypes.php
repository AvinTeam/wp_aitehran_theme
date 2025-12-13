<?php
namespace TAI\App\Modules\PostTypes;

use TAI\App\Core\PostType;

( defined( 'ABSPATH' ) ) || exit;

class MATArtPostTypes extends PostType {
    public function __construct() {
        add_action('init', [ $this, 'register' ]);
    }

    public function register() {

        $labels = array(
            'name'                  => 'اثر',
            'singular_name'         => 'اثر',
            'menu_name'             => 'اثر ها',
            'name_admin_bar'        => 'اثر',
            'add_new'               => 'اضافه کردن',
            'add_new_item'          => 'اضافه کردن اثر',
            'new_item'              => 'اثر جدید',
            'edit_item'             => 'ویرایش اثر',
            'view_item'             => 'نمایش اثر',
            'all_items'             => 'همه اثر ها',
            'search_items'          => 'جست و جو اثر',
            'parent_item_colon'     => 'اثر والد: ',
            'not_found'             => 'اثری یافت نشد',
            'not_found_in_trash'    => 'اثری در سطل زباله یافت نشد',
            'featured_image'        => 'کاور اثر',
            'set_featured_image'    => 'انتخاب تصویر',
            'remove_featured_image' => 'حذف تصویر',
            'use_featured_image'    => 'استفاده به عنوان کاور',
            'archives'              => 'دسته بندی اثر',
            'insert_into_item'      => 'در اثر درج کنید',
            'uploaded_to_this_item' => 'در این اثر درج کنید',
            'filter_items_list'     => 'فیلتر اثر',
            'items_list_navigation' => 'پیمایش اثر',
            'items_list'            => 'لیست اثر',
        );




        $args = array(
            'labels'               => $labels,
            'hierarchical'         => false,
            'show_ui'              => true,
            'show_in_menu'         => true,
            'menu_position'        => 5,
            'query_var'            => true,
            'menu_icon'            => 'dashicons-art',
            'public'               => true,
            'capability_type'      => 'matart',
            'map_meta_cap'         => true,
            'supports'             => array( 'title', 'author', 'custom-fields' ),
            'rewrite'              => false,
            'delete_with_user'     => true,
        );

        

        register_post_type( 'matart', $args );

    }

}
