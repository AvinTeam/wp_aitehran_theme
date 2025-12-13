<?php
namespace TAI\App\Modules\PostTypes;

use TAI\App\Core\PostType;

( defined( 'ABSPATH' ) ) || exit;

class AcademyPostTypes extends PostType {
    public function __construct() {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register() {

        $labels = array(
            'name'                  => 'آموزش',
            'singular_name'         => 'آموزش',
            'menu_name'             => 'آموزش ها',
            'name_admin_bar'        => 'آموزش',
            'add_new'               => 'اضافه کردن',
            'add_new_item'          => 'اضافه کردن آموزش',
            'new_item'              => 'آموزش جدید',
            'edit_item'             => 'ویرایش آموزش',
            'view_item'             => 'نمایش آموزش',
            'all_items'             => 'همه آموزش ها',
            'search_items'          => 'جست و جو آموزش',
            'parent_item_colon'     => 'آموزش والد: ',
            'not_found'             => 'آموزشی یافت نشد',
            'not_found_in_trash'    => 'آموزشی در سطل زباله یافت نشد',
            'featured_image'        => 'کاور آموزش',
            'set_featured_image'    => 'انتخاب تصویر',
            'remove_featured_image' => 'حذف تصویر',
            'use_featured_image'    => 'استفاده به عنوان کاور',
            'archives'              => 'دسته بندی آموزش',
            'insert_into_item'      => 'در آموزش درج کنید',
            'uploaded_to_this_item' => 'در این آموزش درج کنید',
            'filter_items_list'     => 'فیلتر آموزش',
            'items_list_navigation' => 'پیمایش آموزش',
            'items_list'            => 'لیست آموزش',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'hierarchical'       => false,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 5,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-welcome-learn-more',
            'capability_type'    => 'post',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'author', 'custom-fields' ),
            'rewrite'            => array( 'slug' => 'academy' ),
            'has_archive'        => true,
         );

        register_post_type( 'academy', $args );

    }

}
