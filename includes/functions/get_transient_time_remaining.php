<?php

if ( ! function_exists( 'get_transient_time_remaining' ) ) {
    function get_transient_time_remaining( $transient_name ) {
        $value = get_transient( $transient_name );

        if ( false === $value ) {
            return 0;
        }

        $current_time = current_time( 'timestamp', true );

        $transient_timeout = '_transient_timeout_' . $transient_name;
        $expiration_time   = get_option( $transient_timeout );

        if ( false === $expiration_time ) {
            return 0;
        }

        $time_remaining = $expiration_time - $current_time;

        return max( 0, $time_remaining );
    }
}
