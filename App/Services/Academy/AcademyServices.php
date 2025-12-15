<?php
namespace TAI\App\Services\Academy;

use TAI\App\Services\Service;
use WP_Query;

( defined( 'ABSPATH' ) ) || exit;

class AcademyServices extends Service {

    public function __construct() {
    }

    public function sidebar() {

        $categories = get_the_category();

        $categoryName = "بدون دسنه بندی";
        $categorySlug = "";

        foreach ( $categories as $category ) {
            if ( ! in_array( $category->slug, array( 'slider' ) ) && 0 == $category->category_parent ) {
                $categoryName = $category->name;
                $categorySlug = $category->slug;
                break;
            }
        }

        if ( ! empty( $categorySlug ) ) {
            $args = array(
                'post_type'      => 'post',
                'category_name'  => $categorySlug,
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'post__not_in'   => array( get_the_ID() ),
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
        }

        return array(
            'title' => $categoryName,
            'items' => $allPost ?? array(),
        );
    }

    public function get_video() {
        $video = get_post_meta( get_the_ID(), '_academy_video', true );

        $image = absint( $video[ 'image' ] ?? 0 );

        $imageUrl = $image ? esc_url( wp_get_attachment_image_url( $image, 'full' ) ) : '';

        if ( $video[ 'video' ] ) {
            $array = array(
                'link'   => $video[ 'video' ],
                'poster' => $imageUrl,
            );
        }

        return $array ?? null;
    }
}
