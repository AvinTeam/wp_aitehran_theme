<?php

use TAI\App\Controllers\Home\HomeController;

get_header();

$homeController = new HomeController;

$homeController->heroSection();
$homeController->statistics();
$homeController->works();
$homeController->banners();
$homeController->gifts();
$homeController->winners();
$homeController->media();
$homeController->news();
$homeController->faq();
$homeController->poster();
$homeController->supporters();

get_footer();
