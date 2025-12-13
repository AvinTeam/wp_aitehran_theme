<?php

use TAI\App\Controllers\Blog\BlogController;

get_header();

$controller = new BlogController(($_GET ?? [  ]));

$controller->header();
$controller->results();
$controller->pagination();

get_footer();
