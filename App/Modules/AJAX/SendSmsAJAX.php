<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Core\AJAX;
use TAI\App\Core\Captcha;
use TAI\App\Core\SendSMS;

( defined( 'ABSPATH' ) ) || exit;

class SendSmsAJAX extends AJAX {

    private $kay = "tai_SendSms";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        $captcha = new Captcha();

        $captchaChecker = $captcha->decryptURL( $_POST[ 'captchaData' ] );

        if ( $captchaChecker[ 'success' ] && strtolower($captchaChecker[ 'data' ]) == strtolower($_POST[ 'captcha' ]) ) {
            if ( sanitize_phone( $_POST[ 'mobileNumber' ] ) !== "" ) {
                wp_send_json_success( SendSMS::otp( sanitize_phone( $_POST[ 'mobileNumber' ] ) ) );
            }

            wp_send_json_error( 'شماره شما به درستی وارد نشده است' );
        } else {
            wp_send_json_error( 'کد امنیتی را به درستی وارد کنید' );
        }

        wp_send_json_error( "ارسال پیامک با مشکل مواجه شده دوباره تلاش کنید" );
    }
}
