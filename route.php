<?php

use TAI\App\Controllers\Panel\PanelController;

get_header();

$controller = new PanelController();

$page  = "login";
$array = array();

if ( is_user_logged_in() ) {
    switch ( $tai_route ) {
        case 'dashboard':
            $page  = $tai_route;
            $array = $controller->dashboard();
            break;

        default:
            wp_redirect( home_url( "/404" ) );
            break;
    }
}

view( "panel/$page", $array );

get_footer();
