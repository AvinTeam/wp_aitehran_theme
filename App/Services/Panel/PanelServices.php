<?php
namespace TAI\App\Services\Panel;

use TAI\App\Services\Service;
use WP_Query;

( defined( 'ABSPATH' ) ) || exit;

class PanelServices extends Service {

    public function __construct() {
    }

    public function dashboard() {
        return array(

            'groupName'                    => get_user_meta( get_current_user_id(), "groupName", true ),
            'groupResponsible'             => get_user_meta( get_current_user_id(), "groupResponsible", true ),
            'groupResponsibleParent'       => get_user_meta( get_current_user_id(), "groupResponsibleParent", true ),
            'groupResponsibleNationalCode' => get_user_meta( get_current_user_id(), "groupResponsibleNationalCode", true ),
            'groupResponsibleBirthday'     => get_user_meta( get_current_user_id(), "groupResponsibleBirthday", true ),
            'groupResponsibleEdu'          => get_user_meta( get_current_user_id(), "groupResponsibleEdu", true ),
            'groupResponsibleAddress'      => get_user_meta( get_current_user_id(), "groupResponsibleAddress", true ),
            'groupResponsibleAddressPost'  => get_user_meta( get_current_user_id(), "groupResponsibleAddressPost", true ),

        );
    }

    public function update( $request ) {

        update_user_meta( get_current_user_id(), "groupName", sanitize_text_field( $request[ 'groupName' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsible", sanitize_text_field( $request[ 'groupResponsible' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsibleParent", sanitize_text_field( $request[ 'groupResponsibleParent' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsibleNationalCode", sanitize_text_field( $request[ 'groupResponsibleNationalCode' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsibleBirthday", sanitize_text_field( $request[ 'groupResponsibleBirthday' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsibleEdu", sanitize_text_field( $request[ '' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsibleAddress", sanitize_text_field( $request[ 'groupResponsibleAddress' ] ) );
        update_user_meta( get_current_user_id(), "groupResponsibleAddressPost", sanitize_text_field( $request[ 'groupResponsibleAddressPost' ] ) );

        return array(
            "massage" => "پیام شما با موفقیت ثبت شد",
            "success" => true,

        );
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
