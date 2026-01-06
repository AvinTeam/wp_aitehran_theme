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
            'items'        => $allPost ?? array(),
        );
    }

    public function get_video() {
        if ( is_user_logged_in() ) {
            $user_meta = get_user_meta( get_current_user_id(), "academy_see", true );

            $user_meta = is_array( $user_meta ) ? $user_meta : array();

            if ( ! in_array( get_the_ID(), $user_meta ) ) {
                $user_meta[  ] = get_the_ID();
                update_user_meta( get_current_user_id(), "academy_see", $user_meta );
            }
        }

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

        $user_see = array();

        if ( is_user_logged_in() ) {
            $user_meta = get_user_meta( get_current_user_id(), "academy_see", true );

            $user_see = is_array( $user_meta ) ? $user_meta : array();
        }

        $args = array(
            'taxonomy'   => 'academy_category',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        );

        $terms = get_terms( $args );

        $all_post = array();

        foreach ( $terms as $term ) {
            $posts = array();

            $args = array(
                'post_type'      => 'academy',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'academy_category',
                        'field'    => 'term_id',
                        'terms'    => $term->term_id,
                    ),
                ),

            );

            foreach ( get_posts( $args ) as $row ) {
                $video = get_post_meta( get_the_ID(), '_academy_video', true );

                $posts[  ] = array(
                    "title"  => get_the_title( $row->ID ),
                    "image"  => post_image_url( $row->ID ),
                    "link"   => get_permalink( $row->ID ),
                    "time"   => ( isset( $video[ 'time' ] ) && ! empty( $video[ 'time' ] ) ) ? $video[ 'time' ] : "00:00",
                    "is_see" => in_array( $row->ID, $user_see ),
                );
            }

            $all_post[  ] = array(
                'title' => $term->name,
                "posts" => $posts,
            );
        }

        return $all_post ?? array();
    }
}
