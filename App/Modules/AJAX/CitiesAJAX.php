<?php
namespace TAI\App\Modules\AJAX;

use TAI\App\Core\AJAX;
use TAI\App\Models\Iran;

( defined( 'ABSPATH' ) ) || exit;

class CitiesAJAX extends AJAX {

    private $kay = "tai_cities";

    public function __construct() {

        add_action( 'wp_ajax_nopriv_' . $this->kay, array( $this, 'callback' ) );
        add_action( 'wp_ajax_' . $this->kay, array( $this, 'callback' ) );

        // throw new \Exception( 'Not implemented' );
    }

    public function callback() {

        if ( absint( $_POST[ "province_id" ] ) ) {
            $cites = Iran::all()->where( "province_id", "=", absint( $_POST[ "province_id" ] ) )->orderBy( "name" )->toArray();
            wp_send_json_success( $cites );
        }

        wp_send_json_error( 'خطا' );

// if ( $province_id = absint( $_POST[ 'province_id' ] ) ) {

//     $irandb = new Iran_Area();

//     $provinces = $irandb->cities( $province_id, false );

//     wp_send_json_success( $provinces );
        // }
    }
}