<?php

    use TAI\App\Controllers\Home\HomeController;

    get_header();

    $homeController = new HomeController();

    $homeController->heroSection();
    $homeController->format();
    $homeController->news(
        "اخبار",
        "var(--bs-warning)",
        "news"
    );
    $homeController->gallery();

    $homeController->news(
        "اخبار هوش مصنوعی",
        "#D3D3D3",
        "ai_news"
    );

    $homeController->videos();

    // $homeController->banners();
    // $homeController->gifts();
    // $homeController->winners();
    // $homeController->media();
    // $homeController->news();
    // $homeController->faq();
    // $homeController->poster();
    // $homeController->supporters();
?>

<?php
    get_footer();
?>

