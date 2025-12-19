<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Controllers\Contacts\ContactsController;
use TAI\App\Core\AJAX;
use TAI\App\Core\Captcha;

( defined( 'ABSPATH' ) ) || exit;

class ContactAJAX extends AJAX {

    private $kay = "tai_contact";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        $captcha = new Captcha();

        $captchaChecker = $captcha->decryptURL( $_POST[ 'captchaData' ] );

        if ( $captchaChecker[ 'success' ] && strtolower( $captchaChecker[ 'data' ] ) == strtolower( $_POST[ 'captcha' ] ) ) {
            $contactsController = new ContactsController();

            $create = $contactsController->create( $_POST );

            if ( $create[ 'success' ] ) {
                wp_send_json_success( $create[ 'massage' ] );
            }

            wp_send_json_error( $create[ 'massage' ] );
        } else {
            wp_send_json_error( 'کد امنیتی را به درستی وارد کنید' );
        }
    }
}