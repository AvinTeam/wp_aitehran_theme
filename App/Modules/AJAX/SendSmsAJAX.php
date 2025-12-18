<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Core\AJAX;

( defined( 'ABSPATH' ) ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class SendSmsAJAX extends AJAX {

    private $kay = "tai_SendSms";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        wp_send_json_success( $_POST );

        // wp_send_json_error( $create[ 'massage' ] );
    }
}
