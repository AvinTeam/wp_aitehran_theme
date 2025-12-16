<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Controllers\Panel\PanelController;
use TAI\App\Core\AJAX;

( defined( 'ABSPATH' ) ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class DashboardAJAX extends AJAX {

    private $kay = "tai_dashboard";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        check_ajax_referer( config( 'app.key' ) . '_dashboardForm_' . get_current_user_id(), 'wpnonce' );

        $controller = new PanelController();

        $create = $controller->update( $_POST );

        if ( $create[ 'success' ] ) {
            wp_send_json_success( $create[ 'massage' ] );
        }

        wp_send_json_error( $create[ 'massage' ] );
    }
}
