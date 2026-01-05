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

            $game = get_option( 'tai_game_settings', array() );


        if ( isset( $_POST[ 'sendForm' ] ) && ! empty( $_POST[ 'sendForm' ] ) && ($game[ 'status' ] ?? false) ) {
            if ( "artInfo" == $_POST[ 'sendForm' ] ) {
                if ( ! isset( $_POST[ '_wpnonce' ] ) || ! wp_verify_nonce( $_POST[ '_wpnonce' ], config( 'app.key' ) . '_art-info' ) ) {
                    setAlert( false, "مشکلی در ثبت اثر پیش آمده لطفا دوباره ارسال کنید." );
                    wp_redirect( home_url( "/panel/art-info/" ) );
                    exit;
                }

                $redirect = $_REQUEST[ '_wp_http_referer' ];
                $result   = ( new PanelController() )->sendArtInfo( $_REQUEST, $_FILES );

                if ( $result->success ) {
                    $redirect = "/panel/artList";

                    if ( "create" == $result->result ) {
                        $redirect = "/panel/art-info/?tracking_code=" . $result->massage;
                    }
                }

                setAlert( $result->success, $result->massage );

                wp_redirect( home_url( $redirect ) );
                exit;
            }
        }

        if ( isset( $_GET[ "delTeem" ] ) && ! empty( $_GET[ 'delTeem' ] ) ) {
            $user = get_user_by( 'login', $_GET[ 'delTeem' ] );

            if ( $user->ID && get_current_user_id() == get_user_meta( $user->ID, "user_leader", true ) ) {
                $user_id = $user->ID;

                require_once ABSPATH . 'wp-admin/includes/user.php';

                if ( wp_delete_user( $user_id ) ) {
                    setAlert( "success", "هم تیمی شما حذف شد" );
                } else {
                    setAlert( false, "مشکلی در هم تیمی پیش آمده لطفا دوباره ارسال کنید." );
                }

                wp_redirect( home_url( "/panel" ) );
                exit;
            }

            dd( $_GET[ 'delTeem' ] );
        }
    }
}
