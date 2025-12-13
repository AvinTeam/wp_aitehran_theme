<?php
namespace TAI\App\Modules\MetaBoxes;

use TAI\App\Core\MetaBoxes;

( defined( 'ABSPATH' ) ) || exit;

class AcademyMetaBoxes extends MetaBoxes {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save' ), 1, 3 );
    }

    public function meta_boxes(): void {

        add_meta_box(
            'tai_academy_video',
            'ویدئو آیه ها',
            array( $this, 'video' ),
            'academy',
            'normal',
            'high',
        );
    }

    public function video( $post ) {

        $video = get_post_meta( $post->ID, '_academy_video', true );

        $image = absint($video[ 'image' ] ?? 0);

        $imageUrl = $image ? esc_url( wp_get_attachment_image_url( $image, 'full' ) ) : '';


        view( 'metaBoxes/academy/video',
            array(
                'video'    => $video[ 'video' ] ?? "",
                'image'    => $image,
                'imageUrl' => $imageUrl,
            ) );
    }

    public function save( $post_id, $post, $updata ) {

        if ( "academy" === $post->post_type ) {
            if ( isset( $_POST[ 'academy' ] ) ) {
                update_post_meta( $post_id, '_academy_video', $_POST[ 'academy' ] );
            }
        }
    }
}
