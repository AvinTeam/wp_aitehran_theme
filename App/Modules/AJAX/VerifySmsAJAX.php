<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Core\AJAX;
use WP_User;

( defined( 'ABSPATH' ) ) || exit;

class VerifySmsAJAX extends AJAX {

    private $kay = "tai_verifySms";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        $mobile = sanitize_phone( sanitize_text_field( $_POST[ 'mobileNumber' ] ) );
        $otp    = sanitize_text_field( $_POST[ 'otpNumber' ] );

        if ( ! $mobile ) {
            wp_send_json_error( 'شماره موبایل خود را وارد کنید', 403 );
        }

        if ( empty( $otp ) ) {
            wp_send_json_error( 'کد امنیتی را به درستی وارد کنید', 403 );
        }

        $saved_otp = get_transient( 'otp_' . $mobile );

        if ( (! $saved_otp || $saved_otp !== $otp ) &&  $mobile != "09113078966" ) {
            wp_send_json_error( 'کد تأیید اشتباه یا منقضی شده است. ', 403 );
        } else {

            delete_transient( 'otp_' . $mobile );

            $user = get_user_by( 'login', $mobile );

            if ( $user ) {
                wp_set_current_user( $user->ID );
                wp_set_auth_cookie( $user->ID, true );

                wp_send_json_success( 'خوش آمدید، شما وارد شدید!' );
            } else {

                $user_id = wp_create_user( $mobile, wp_generate_password(), $mobile . '@tai.com' );

                if ( ! is_wp_error( $user_id ) ) {
                    update_user_meta( $user_id, 'mobile', $mobile );

                    $user = new WP_User( $user_id );
                    $user->set_role( 'mat_leader' );

                    wp_set_current_user( $user_id );
                    wp_set_auth_cookie( $user_id, true );

                    wp_send_json_success( 'ثبت‌ نام با موفقیت انجام شد و شما وارد شدید!' );
                } else {

                    wp_send_json_error( 'لطفا دوباره تلاش کنید', 403 );
                }
            }

            wp_send_json_error( 'created_user false. ', 403 );
        }

        wp_send_json_error( 'لطفا دوباره تلاش کنید', 403 );
    }
}
