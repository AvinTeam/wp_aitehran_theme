<?php

    use TAI\App\Controllers\Page\PageController;

    get_header();

    $controller = new PageController;

    $controller->header();
    $controller->content();
?>






<?php get_footer(); ?>