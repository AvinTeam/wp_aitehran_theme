<?php
namespace TAI\App\Services\Blog;

use TAI\App\Core\Traits\JDF;
use TAI\App\Services\Service;
use WP_Query;

( defined( 'ABSPATH' ) ) || exit;

class BlogServices extends Service {
    use JDF;
    private $sections        = array();
    private int $total_items = 0;
    private int $paged       = 1;
    private int $par_page    = 12;

    public function __construct( array $result ) {

        $this->paged = ( isset( $result[ 'page' ] ) && absint( $result[ 'page' ] ) >= 1 ) ? absint( $result[ 'page' ] ) : 1;

        $this->sections = get_option( 'tai_sections', array() );
    }

    public function pagination() {

        $url = home_url( '/blog/' );

        generatePagination( $url, $this->par_page, $this->total_items, $this->paged );
    }

    public function sidebar( $sidebarTitle ) {

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
            "sidebar_title" => $sidebarTitle ?? "آرشیو اخبار",
            'items'         => $allPost ?? array(),
        );
    }

    public function get_video() {
        $video = get_post_meta( get_the_ID(), '_post_video', true );

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

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $this->par_page,
            'paged'          => $this->paged,
            'fields'         => 'ids',
        );

        if ( $term = get_queried_object() ) {
            $args[ "category_name" ] = $term->slug;
        }

        $query = new WP_Query( $args );

        $total_posts       = $query->found_posts;
        $this->total_items = $total_posts;

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                $id = get_the_ID();

                $video = get_post_meta( get_the_ID(), '_post_video', true );

                $posts[  ] = array(
                    "title" => get_the_title( $id ),
                    "image" => post_image_url( $id ),
                    "link"  => get_permalink( $id ),
                    "time"  => ( isset( $video[ 'time' ] ) && ! empty( $video[ 'time' ] ) ) ? $video[ 'time' ] : "00:00",
                );
            }
        }

        wp_reset_postdata();
        return $posts ?? array();
    }
}
