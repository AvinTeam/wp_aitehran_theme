<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Controllers\Contacts\ContactsController;
use TAI\App\Core\AJAX;

( defined( 'ABSPATH' ) ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class ContactAJAX extends AJAX {

    private $kay = "tai_contact";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        $contactsController = new ContactsController();

        $create = $contactsController->create( $_POST );

        if ( $create[ 'success' ] ) {
            wp_send_json_success( $create[ 'massage' ] );
        }

        wp_send_json_error( $create[ 'massage' ] );
    }
}
