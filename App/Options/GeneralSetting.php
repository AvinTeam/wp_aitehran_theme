<?php
namespace TAI\App\Options;

use TAI\App\Core\Options;

( defined( 'ABSPATH' ) ) || exit;

class GeneralSetting extends Options {

    public static function get() {
        return self::getter();
    }

    public static function set( array $input ) {

        if ( ! isset( $input[ 'socials' ] ) ) {
            $input[ 'socials' ] = array();
        }

        if ( ! isset( $input[ 'googleMap' ] ) ) {
            $input[ 'googleMap' ] = sanitize_textarea_field( wp_unslash( $input[ 'googleMap' ] ) );
        }

        return self::setter( $input );
    }
}
