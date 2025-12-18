<?php
namespace TAI\App\Modules\MetaBoxes;

use TAI\App\Core\MetaBoxes;

( defined( 'ABSPATH' ) ) || exit;

class ARTMetaBoxes extends MetaBoxes {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );
        // add_action( 'pre_post_update', array( $this, 'mat_save_bax' ), 10, 2 );
    }

    public function meta_boxes(): void {

        add_meta_box(
            'mat_teem',
            "اطلاعات اثر",
            array( $this, 'callback' ),
            'matart',
            'normal',
            'default'
        );
    }

    public function callback( $post ) {

        $this->art_file( $post );
        $this->art_teem( $post );
        $this->art_year( $post );
        $this->art_ownership( $post );
    }

    public function art_file( $post ) {

        $mat_file = absint( get_post_meta( $post->ID, '_art_file', true ) );
        $file_url = wp_get_attachment_url( $mat_file );

        $mat_file_art = $file_url ? $file_url : "";

        if ( $mat_file_art ) {
            view( 'metaBoxes/art/file',
                array(
                    'mat_file_art' => $mat_file_art,

                ) );
        }
    }

    public function art_teem( $post ) {

        $teem_list = get_post_meta( $post->ID, "_art_teem", true );

        view( 'metaBoxes/art/teem',
            array(
                'leaderName' => get_user_meta( get_current_user_id(), "groupResponsible", true ),
                'groupName'  => get_user_meta( get_current_user_id(), "groupName", true ),
                'teem_list'  => is_array( $teem_list ) ? $teem_list : array(),

            ) );
    }

    public function art_ownership( $post ) {

        $art_ownership = get_post_meta( $post->ID, "_art_ownership", true );

        if ( ! empty( $art_ownership ) ) {
            $ownership = absint( $art_ownership ) ? "حقیقی" : "حقوقی  (  $art_ownership  )";
        }

        if ( isset( $ownership ) ) {
            view( 'metaBoxes/art/ownership',
                array(
                    'ownership' => $ownership ?? '',

                ) );
        }
    }

    public function art_year( $post ) {

        $year = get_post_meta( $post->ID, "_art_year", true );

        if ( $year ) {
            view( 'metaBoxes/art/year',
                array(
                    'year' => $year,

                ) );
        }
    }

    public function art_documentation( $post ) {

        $documentation = get_post_meta( $post->ID, "_art_documentation", true );

        if ( is_array( $documentation ) ) {
            foreach ( $documentation as $document ) {
                $document_list[  ] = wp_get_attachment_url( absint( $document ) );
            }
        }

        if ( $documentation ) {
            view( 'metaBoxes/art/documentation',
                array(
                    'documentation' => $document_list ?? array(),

                ) );
        }
    }

// public function mat_save_bax( $post_id, $data ) {

//     if ( isset( $_POST[ 'mat_form' ] ) ) {

//         $current_categories = wp_get_post_terms( $post_id, 'format_art', array( 'fields' => 'ids' ) );

//         $submitted_categories = isset( $_POST[ 'tax_input' ][ 'format_art' ] ) ? array_map( 'intval', $_POST[ 'tax_input' ][ 'format_art' ] ) : array();

//         unset( $submitted_categories[ 0 ] );

//         if ( array_diff( $current_categories, $submitted_categories ) || array_diff( $submitted_categories, $current_categories ) ) {

//             update_post_meta( $post_id, '_mat_total_points', 0 );

//             update_post_meta( $post_id, '_mat_referee_id', 0 );

//             update_post_meta( $post_id, '_mat_form_points', '' );

//         } else {

//             update_post_meta( $post_id, '_mat_area', absint( $_POST[ 'mat_form' ][ 'area' ] ) );

//             update_post_meta( $post_id, '_mat_file_art', absint( $_POST[ 'mat_form' ][ 'file' ] ) );

//             $format_art_question = unserialize( get_term_meta( absint( $_POST[ 'tax_input' ][ 'format_art' ][ 1 ] ), 'format_art_question', true ) );

//             $format_art_question = ( is_array( $format_art_question ) ) ? $format_art_question : array();

//             $rating = array();

//             foreach ( $format_art_question as $key => $question ) {

//                 $input = absint( $_POST[ 'rating' ][ $key ] );

//                 if ( $input <= 0 ) {

//                     $rating[  ] = 0;

//                 } elseif ( $input > $question[ 'point' ] ) {

//                     $rating[  ] = $question[ 'point' ];

//                 } else {

//                     $rating[  ] = $input;

//                 }

//             }

//             update_post_meta( $post_id, '_mat_total_points', absint( array_sum( $rating ) ) );

//             update_post_meta( $post_id, '_mat_form_points', serialize( $rating ) );

//             $referee_id = absint( get_post_meta( $post_id, '_mat_referee_id', true ) );

//             if ( ! $referee_id ) {

//                 update_post_meta( $post_id, '_mat_referee_id', get_current_user_id() );

//             }

//         }

//     }
    // }
}
