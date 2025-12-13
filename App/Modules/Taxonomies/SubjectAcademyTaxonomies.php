<?php
namespace TAI\App\Modules\Taxonomies;

use TAI\App\Core\Taxonomies;

( defined( 'ABSPATH' ) ) || exit;

class SubjectAcademyTaxonomies extends Taxonomies {

    public function __construct() {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register() {
        $subject_art_labels = array(
            'name'                  => 'دسته بندی آموزش',
            'singular_name'         => 'دسته بندی آموزش',
            'search_items'          => 'جست و جو دسته بندی آموزش',
            'popular_items'         => 'دسته بندی آموزش محبوب',
            'all_items'             => 'دسته بندی آموزش',
            'edit_item'             => 'ویرایش دسته بندی آموزش',
            'update_item'           => 'بروزرسانی دسته بندی آموزش',
            'add_new_item'          => 'افزودن دسته بندی آموزش',
            'new_item_name'         => 'نام دسته بندی آموزش جدید',
            'add_or_remove_items'   => 'اضافه کردن یا حذف دسته بندی آموزش',
            'choose_from_most_used' => 'از میان دسته بندی آموزش پرکاربرد انتخاب کنید',
            'not_found'             => 'دسته بندی آموزشی را یافت نشد',
            'menu_name'             => 'دسته بندی آموزش',
        );

        $subject_art = array(
            'hierarchical'      => true,
            'labels'            => $subject_art_labels,
            'show_ui'           => true,
            'show_in_rest'      => false,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'academy_category' ),
        );

        register_taxonomy( 'academy_category', 'academy', $subject_art );
    }

}
