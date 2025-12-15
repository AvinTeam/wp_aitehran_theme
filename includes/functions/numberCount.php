<?php
( defined( 'ABSPATH' ) ) || exit;

if ( ! function_exists( 'numberCount' ) ) {
    function numberCount( $number ) {

        if ( $number < 1000 ) {
            return $number;
        }

        $units = array( 'k', 'M', 'B', 'T' );

        foreach ( $units as $i => $unit ) {
            $divider = pow( 1000, $i + 1 );

            if ( $number < $divider * 1000 ) {
                $value = $number / $divider;

                if ( floor( $value ) == $value ) {
                    return (int) $value . $unit;
                }

                $formatted = round( $value, 1 );

                if ( floor( $formatted ) == $formatted ) {
                    return (int) $formatted . $unit;
                }

                $result = rtrim( rtrim( sprintf( "%.1f", $formatted ), '0' ), '.' );
                return $result . $unit;
            }
        }
    }
}