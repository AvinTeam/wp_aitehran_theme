<?php

    use TAI\App\Controllers\Search\SearchController;

    get_header();

    $controller = new SearchController(($_GET ?? [  ]));

    $controller->header();
    $controller->results();
    $controller->pagination();


 get_footer(); ?>