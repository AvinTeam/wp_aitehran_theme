<?php
namespace TAI\App\Services\Academy;

use TAI\App\Services\Service;
use WP_Query;

( defined( 'ABSPATH' ) ) || exit;

class AcademyServices extends Service {

    public function __construct() {
    }

    public function sidebar() {

        $args = array(
            'post_type'      => 'post',
            'category_name'  => "news",
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'orderby'        => 'rand',

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
            'items' => $allPost ?? array(),
        );
    }

    public function get_video() {
        $video = get_post_meta( get_the_ID(), '_academy_video', true );

        $image = absint( $video[ 'image' ] ?? 0 );

        $imageUrl = $image ? esc_url( wp_get_attachment_image_url( $image, 'full' ) ) : '';

        if ( isset( $video[ 'video' ] ) ) {
            $array = array(
                'link'   => $video[ 'video' ],
                'poster' => $imageUrl,
            );
        }

        return $array ?? null;
    }

    public function archive() {

        $parent_args = array(
            'taxonomy'   => 'academy_category',
            'hide_empty' => false,
            'parent'     => 0,
            'orderby'    => 'name',
            'order'      => 'ASC',
        );

        foreach ( get_terms( $parent_args ) ?? array() as $parent_term ) {
            $child = array();

            $child_args = array(
                'taxonomy'   => 'academy_category',
                'hide_empty' => false,
                'parent'     => $parent_term->term_id,
                'orderby'    => 'name',
                'order'      => 'ASC',
            );

            foreach ( get_terms( $child_args ) ?? array() as $child_term ) {
                $child[  ] = array(
                    "id"   => $child_term->term_id,
                    "name" => $child_term->name,
                    "link" => get_category_link( $child_term->term_id ),
                );
            }

            $items[  ] = array(
                "id"    => $parent_term->term_id,
                "name"  => $parent_term->name,
                "link"  => get_category_link( $parent_term->term_id ),
                "child" => $child,
            );
        }

        return array(
            "items" => $items ?? array(),
        );
    }

    public function taxonomy() {

        $current_category_id = get_queried_object_id();


        $posts = array();

        $args = array(

            'post_type'      => 'academy',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'academy_category',
                    'field'    => 'term_id',
                    'terms'    => $current_category_id,
                ),

            ),

        );

        foreach ( get_posts( $args ) as $row ) {
            $video = get_post_meta( get_the_ID(), '_academy_video', true );

            $posts[  ] = array(

                "title" => get_the_title( $row->ID ),
                "image" => post_image_url( $row->ID ),
                "link"  => get_permalink( $row->ID ),
                "time"  => ( isset( $video[ 'time' ] ) && ! empty( $video[ 'time' ] ) ) ? $video[ 'time' ] : "00:00",
            );
        }
        return array(
            'title' => get_the_archive_title() ,
            "posts" => $posts ?? array(  ),
        );
    }
}
