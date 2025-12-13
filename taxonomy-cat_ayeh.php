<?php

use TAI\App\Controllers\Ayeh\AyehTaxonomyController;
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
    if ($item->url == "/" . config('urls.campaigns')) {
        $classes[  ] = "current-menu-item";
        $classes[  ] = "active";
    }
    return $classes;
}, 11, 3);
get_header();

$controller = new AyehTaxonomyController($_GET);
$controller->header();
$controller->List();
$controller->pagination();

get_footer();
