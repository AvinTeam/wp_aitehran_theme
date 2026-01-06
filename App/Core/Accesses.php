<?php
namespace TAI\App\Core;

use TAI\App\Core\Traits\JDF;

( defined( 'ABSPATH' ) ) || exit;

class Accesses {

    use JDF;

    public function __construct() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_action( 'after_setup_theme', array( $this, 'nav_menu_theme_setup' ) );
        add_filter( 'wp_title', array( $this, 'title_filter' ) );
        add_filter( 'get_the_archive_title_prefix', array( $this, 'archive_title_prefix' ) );
        add_filter( 'posts_search', array( $this, 'search_by_meta' ), 10, 2 );

        add_filter( 'get_the_date', array( $this, 'get_the_date' ) );

        add_action( 'admin_init', array( $this, 'restrict_admin_access' ) );

        add_filter( 'show_admin_bar', array( $this, 'disable_admin_bar_for_specific_roles' ) );
    }

    public function nav_menu_theme_setup() {
        register_nav_menus( array(
            'main-menu' => 'فهرست هدر',
            // 'footer-menu'      => 'فهرست فوتر',
         ) );
    }

    public function title_filter( $title ) {

        if ( is_home() || is_front_page() ) {
            $title = get_bloginfo( 'name' );
        } elseif ( is_single() || is_page() ) {
            $title = get_the_title() . " | " . get_bloginfo( 'name' );
        } elseif ( is_category() ) {
            $title = single_cat_title( '', false ) . " | " . get_bloginfo( 'name' );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false ) . " | " . get_bloginfo( 'name' );
        } elseif ( is_search() ) {
            $title = "نتایج جستجو برای " . get_search_query();
        } elseif ( is_tax( 'cat_ayeh' ) ) {
            $title = "منابع پویش " . get_the_archive_title() . " | " . get_bloginfo( 'name' );
        } elseif ( is_404() ) {
            $title = "صفحه پیدا نشد | " . get_bloginfo( 'name' );
        } else {
            $title = get_bloginfo( 'name' );
        }

        return $title;
    }

    public function archive_title_prefix( $prefix ) {

        $prefix = '';

        return $prefix;
    }

    public function search_by_meta( $search, $wp_query ) {
        global $wpdb;

        if ( empty( $search ) || ! $wp_query->is_search() ) {
            return $search;
        }

        $search_term = $wp_query->query_vars[ 's' ];
        $like        = '%' . $wpdb->esc_like( $search_term ) . '%';

        $search = $wpdb->prepare( " AND (
        ({$wpdb->posts}.post_title LIKE %s)
        OR ({$wpdb->posts}.post_content LIKE %s)
        OR EXISTS (
            SELECT 1 FROM {$wpdb->postmeta}
            WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
            AND {$wpdb->postmeta}.meta_value LIKE %s
        )
        )", $like, $like, $like );

        return $search;
    }

    public function get_the_date( $the_date ) {
        return $this->date( $the_date, 'm' );
    }

    public function restrict_admin_access() {

        if ( ! is_user_logged_in() ) {
            return;
        }

        $user             = wp_get_current_user();
        $restricted_roles = array( 'mat_leader', 'subscriber', 'mat_admin', 'mat_referee' );

        if ( array_intersect( $restricted_roles, $user->roles ) && ! defined( 'DOING_AJAX' ) ) {
            wp_redirect( home_url() );
            exit;
        }
    }

    public function disable_admin_bar_for_specific_roles( $show ) {

        if ( is_user_logged_in() ) {
            $user             = wp_get_current_user();
            $restricted_roles = array( 'mat_leader', 'mat_user', 'mat_admin', 'mat_referee' );

            if ( array_intersect( $restricted_roles, $user->roles ) ) {
                return false;
            }
        }

        return $show;
    }
}
