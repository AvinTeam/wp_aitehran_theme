<?php
namespace TAI\App\Core;

use TAI\App\Controllers\Panel\PanelController;

( defined( 'ABSPATH' ) ) || exit;

class Init {

    public function __construct() {

        add_action( 'init', array( $this, 'init' ), 11 );
    }

    /**
     * Fires after WordPress has finished loading but before any headers are sent.
     *
     */
    public function init(): void {

        if ( isset( $_POST[ 'sendForm' ] ) && ! empty( $_POST[ 'sendForm' ] ) ) {
            if ( "artInfo" == $_POST[ 'sendForm' ] ) {
                if ( ! isset( $_POST[ '_wpnonce' ] ) || ! wp_verify_nonce( $_POST[ '_wpnonce' ], config( 'app.key' ) . '_art-info' ) ) {
                    setAlert( "danger", "مشکلی در ثبت اثر پیش آمده لطفا دوباره ارسال کنید." );
                    wp_redirect( home_url( "/panel/art-info/" ) );
                }

                $redirect = $_REQUEST[ '_wp_http_referer' ];
                $result   = ( new PanelController() )->sendArtInfo( $_REQUEST, $_FILES );

                if ( $result->success ) {
                    $redirect = "/panel/artList";

                    if ( "create" == $result->result ) {
                        $redirect = "/panel/art-info/?tracking_code=" . $result->massage;
                    }
                }

                if ( ! $result->result ) {
                    setAlert( $result->success, $result->massage );
                }

                wp_redirect( home_url( $redirect ) );
                exit;
            }
        }
    }
}
