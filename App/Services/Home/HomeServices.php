<?php
namespace TAI\App\Services\Home;

use TAI\App\Services\Service;
use WP_Query;

( defined( 'ABSPATH' ) ) || exit;

class HomeServices extends Service {

    public function __construct() {
    }

    public function heroSection() {

        $args = array(
            'post_type'      => 'post',
            'category_name'  => "sliders",
            'posts_per_page' => 5,
            'post_status'    => 'publish',

        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):

            while ( $query->have_posts() ): $query->the_post();
                $allPost[  ] = array(
                    "title" => get_the_title(),
                    "image" => post_image_url(),
                    "link"  => get_permalink(),
                );
            endwhile;

            wp_reset_postdata();
        endif;

        return array(
            'items'   => $allPost ?? array(),
            'panel'   => home_url( "/panel" ),
            'academy' => home_url( "/academy" ),

        );
    }

    public function format() {
        $banners = get_option( 'tai_banner' );

        if ( ! empty( $banners ) ) {
            $banners = unserialize( $banners );

            foreach ( $banners as $value ) {
                $items[  ] = array(
                    'url'  => get_the_image_url_by_id( $value[ 'image' ] ),
                    'link' => $value[ 'link' ],
                );
            }
        }

        // $formats = array_map( "basename", glob( TAI_PATH . 'assets/image/formats/*' ) );

        return array(
            "formats" => $items ?? array(  ),
        );
    }

    public function tai_get_posts_by_category( $category, $per_page ) {

        $args = array(
            'post_type'      => 'post',
            'category_name'  => $category,
            'posts_per_page' => $per_page,
            'post_status'    => 'publish',

        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):

            while ( $query->have_posts() ): $query->the_post();
                $allPost[  ] = array(
                    "title" => get_the_title(),
                    "image" => post_image_url(),
                    "link"  => get_permalink(),
                    "date"  => get_the_date(),
                );
            endwhile;

            wp_reset_postdata();
        endif;

        return $allPost ?? array();
    }

    public function videos() {
        $args = array(
            'post_type'      => 'post',
            'category_name'  => "videos",
            'posts_per_page' => 1,
            'post_status'    => 'publish',

        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ):

            while ( $query->have_posts() ): $query->the_post();
                $allPost[  ] = array(
                    "title"   => get_the_title(),
                    "image"   => post_image_url(),
                    "link"    => get_permalink(),
                    "content" => get_the_content( null, false, get_the_ID() ),
                );
            endwhile;

            wp_reset_postdata();
        endif;

        return $allPost ?? array();
    }

}