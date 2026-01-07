<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Controllers\Panel\PanelController;
use TAI\App\Core\AJAX;

( defined( 'ABSPATH' ) ) || exit;


class AddTeemAJAX extends AJAX {

    private $kay = "tai_addTeem";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        check_ajax_referer( config( 'app.key' ) . '_addTeemForm_' . get_current_user_id(), 'wpnonce' );

        $controller = new PanelController();

        

        if ( $_POST[ 'username' ] ) {
            $create = $controller->updateTeem( $_POST );
        } else {
            $create = $controller->addTeem( $_POST );
        }
        
        if ( $create[ 'success' ] ) {
            wp_send_json_success( home_url( '/panel/addTeem' ) );
        }

        wp_send_json_error( $create[ 'massage' ] );
    }
}
