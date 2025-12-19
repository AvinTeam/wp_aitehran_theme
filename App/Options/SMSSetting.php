<?php
namespace TAI\App\Options;

use TAI\App\Core\Options;

( defined( 'ABSPATH' ) ) || exit;

class SMSSetting extends Options {

    public static function get() {
        return self::getter();
    }

    public static function set( array $input ) {

   
        
        

        return self::setter( $input );
    }
}
