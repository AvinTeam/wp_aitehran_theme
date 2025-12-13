<?php

    use TAI\App\Modules\NavMenus\MainNavWalker;
    use TAI\App\Options\GeneralSetting;

    $general = GeneralSetting::get();

    $appLinks = typeLinkArray(($general[ 'appLinks' ] ?? [  ]));
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body class="">
    <header class="container p-lg-0 px-2">
        <div class="container mt-3 border border-1 border-gold rounded-circle px-24 py-12 d-flex justify-content-between align-items-center">
            <a href="<?php echo home_url('/') ?>"><img
                    src="<?php echo get_the_image_url_by_id(($general[ 'logo' ][ "header" ] ?? 0)) ?>"
                    alt="<?php echo bloginfo('name') ?>" style="height: 68px;"></a>

            <nav class="navbar navbar-expand-lg d-none d-lg-block">
                <?php
                wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                    'depth'          => 2,
                    'walker'         => new MainNavWalker(),
                 ]);
                ?>
            </nav>

            <div class="d-flex justify-content-center align-items-center gap-12">
                <a href="<?php echo esc_url(($appLinks[ 'url' ] ?? '#')) ?>" target="_blank"
                    class="btn btn-primary rounded-circle px-24 py-12">دانلود اپ</a>

                <a href="tel:<?php echo sanitize_phone($general[ 'phone' ]) ?>"
                    class="btn btn-outline-primary btn-bg rounded-circle p-8 border-0 d-none d-lg-inline">
                    <i class="bi bi-telephone f-24 p-0 m-0 d-block w-30 h-30"></i>
                </a>

                <button type="button"
                    class="btn btn-outline-primary btn-bg rounded-circle p-8 border-0 d-none d-lg-inline searchBtn">
                    <i class="bi bi-search f-24 p-0 m-0 d-block w-30 h-30"></i>
                </button>

                <button class="btn btn-outline-primary rounded-circle p-8 border-0 d-lg-none " type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                    <i class="bi bi-list f-24 p-0 m-0 d-block w-30 h-30"></i>
                </button>
            </div>
        </div>
    </header>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
        <div
            class="offcanvas-header d-flex flex-row justify-content-between align-items-center h-72px secondary-shade-4">
            <button type="button" class="btn-close mx-1" data-bs-dismiss="offcanvas">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="d-flex flex-row justify-content-center align-items-center gap-12">

                <a href="tel:<?php echo sanitize_phone($general[ 'phone' ]) ?>"
                    class="btn btn-outline-primary btn-bg rounded-circle p-8 border-0">
                    <i class="bi bi-telephone f-24 p-0 m-0 d-block w-30 h-30"></i>
                </a>

                <button type="button" class="btn btn-outline-primary btn-bg rounded-circle p-8 border-0 searchBtn">
                    <i class="bi bi-search f-24 p-0 m-0 d-block w-30 h-30"></i>
                </button>
            </div>
            <nav
                class="navbar navbar-expand-lg text-center d-flex flex-column justify-content-center align-items-center mt-24">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav mb-2 mb-lg-0',
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'depth'          => 2,
                        'walker'         => new MainNavWalker(),
                     ]);
                ?>
            </nav>
        </div>
    </div>