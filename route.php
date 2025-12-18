<?php

use TAI\App\Controllers\Panel\PanelController;

get_header();

$controller = new PanelController();

$site_page  = "login";
$array = array();

if ( is_user_logged_in() ) {
    $site_page = $tai_route;

    switch ( $tai_route ) {
        case 'dashboard':
            $array = $controller->dashboard();
            break;
        case 'addTeem':
            $array = $controller->getTeem();
            break;
        case 'artList':
            $array = $controller->artList();
            break;
        case 'art-info':
            $array = $controller->artInfo();
            break;

        default:
            wp_redirect( home_url( "/404" ) );
            break;
    }
}

view( "panel/$site_page", $array );

get_footer();
