<?php
namespace TAI\App\Modules\Taxonomies;

use TAI\App\Core\Taxonomies;

( defined( 'ABSPATH' ) ) || exit;

class SubjectArtTaxonomies extends Taxonomies {

    public function __construct() {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register() {
        $subject_art_labels = array(
            'name'                  => 'موضوع ها',
            'singular_name'         => 'موضوع ها',
            'search_items'          => 'جست و جو موضوع ها',
            'popular_items'         => 'موضوع ها محبوب',
            'all_items'             => 'موضوع ها',
            'edit_item'             => 'ویرایش موضوع',
            'update_item'           => 'بروزرسانی موضوع',
            'add_new_item'          => 'افزودن موضوع',
            'new_item_name'         => 'نام موضوع جدید',
            'add_or_remove_items'   => 'اضافه کردن یا حذف موضوع',
            'choose_from_most_used' => 'از میان موضوع ها پرکاربرد انتخاب کنید',
            'not_found'             => 'موضوعی را یافت نشد',
            'menu_name'             => 'موضوع ها',
        );

        $subject_art = array(
            'hierarchical'      => true,
            'labels'            => $subject_art_labels,
            'show_ui'           => true,
            'show_in_rest'      => false,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'subject_art' ),
        );

        register_taxonomy( 'subject_art', 'matart', $subject_art );
    }

}
