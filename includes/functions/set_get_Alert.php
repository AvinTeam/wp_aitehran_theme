<?php

( defined( 'ABSPATH' ) ) || exit;

function setAlert( $success, $massage ) {

    $result = ( ( $success || "success" == $success ) ? "success" : "danger" ) . "|" . $massage;

    setcookie( "general_transient", $result, time() + 1800, "/" );
}

function getAlert() {

    $cookie = $_COOKIE[ "general_transient" ] ?? null;

    if ( isset( $cookie ) && ! empty( $cookie ) ) {
        setcookie( "general_transient", '', time() - 1800, "/" );
        unset( $_COOKIE[ "general_transient" ] );

        $res = explode( "|", $cookie );

        echo '<div class="alert alert-' . trim( $res[ 0 ] ) . '" role="alert">' . trim( $res[ 1 ] ) . '</div>';
    }
}
