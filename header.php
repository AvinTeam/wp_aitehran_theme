<?php

    use TAI\App\Modules\NavMenus\MainNavWalker;
    use TAI\App\Options\GeneralSetting;

    $general = GeneralSetting::get();

    // dd($general['socials']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>

<body class="">



    <header class="container-fluid bg-primary">

        <div class="container d-flex justify-content-between align-items-center align-items-lg-start gap-3 gap-lg-1">
            <div class="d-flex flex-column justify-content-center align-items-start my-4 w-100">
                <a href="<?php echo home_url( "/" )?>" class="logo">
                    <img class="w-100" src="<?php echo get_the_image_url( 'logo.png' ) ?>"
                        alt="<?php echo bloginfo( 'name' ) ?>">

                </a>
                <nav class="navbar navbar-expand-lg d-none d-lg-block">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'main-menu',
                            'container'      => false,
                            'menu_class'     => 'navbar-nav me-auto mb-2 mb-lg-0',
                            'fallback_cb'    => '__return_false',
                            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                            'depth'          => 2,
                            'walker'         => new MainNavWalker(),
                        ) );
                    ?>
                </nav>
            </div>


            <div class="d-none d-lg-flex flex-row justify-content-end gap-2">

                <div class="d-flex flex-column justify-content-end align-items-center row-gap-2">
                    <div
                        class="socials d-flex justify-content-start align-items-center align-content-center gap-12 align-self-stretch flex-nowrap">
                        <?php

                        foreach ( typeLinkArray( ( $general[ 'socials' ] ?? array() ) ) as $key => $value ): ?>
                        <a class="" href="<?php echo esc_url( $value ) ?>">
                            <div
                                class=" d-flex justify-content-center align-items-center p-2 rounded-circle bg-secondary ">
                                <div class="w-24 h-24 ">
                                    <img class="w-100"
                                        src="<?php echo get_the_image_url( 'social/' . $key . '.png' ) ?>">
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <form id="search-header" class="w-100 position-relative">
                        <input type="text" name="search" id="search-header-input"
                            class="form-control w-100 rounded-circle bg-primary border border-1 border-secondary text-white"
                            aria-label="Search" value="" placeholder="جستجو">
                        <i class="bi bi-search text-secondary position-absolute" style="left: 12px; top: 25%;"></i>
                    </form>
                </div>

                <div class="bg-secondary h-120  px-4 pb-3 d-flex align-items-end">
                    <a class="btn btn-link fw-bold f-20 text-nowrap" href="#contact_us">ارتباط با ما</a>
                </div>

            </div>

            <button class="btn btn-outline-secondary rounded-circle p-8 border-0 d-lg-none " type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="bi bi-list f-24 p-0 m-0 d-block w-30 h-30"></i>
            </button>
        </div>

    </header>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
        <div
            class="offcanvas-header d-flex flex-row justify-content-between align-items-center h-72px secondary-shade-4">
            <button type="button" class="btn-close mx-1" data-bs-dismiss="offcanvas">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>


        <div class="offcanvas-body d-flex flex-column row-gap-3 justify-content-start align-items-center">
            <form id="search-header" class="w-100 position-relative">
                <input type="text" name="search" id="search-header-input"
                    class="form-control w-100 rounded-circle bg-primary border border-1 border-secondary text-white"
                    aria-label="Search" value="" placeholder="جستجو">
                <i class="bi bi-search text-secondary position-absolute" style="left: 12px; top: 25%;"></i>
            </form>



            <nav class="navbar navbar-expand-lg w-100">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav me-auto mb-2 mb-lg-0 row-gap-2 w-100',
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'depth'          => 2,
                        'walker'         => new MainNavWalker(),
                    ) );
                ?>
            </nav>


            <div
                class="socials d-flex justify-content-center align-items-center align-content-center gap-12 align-self-stretch flex-wrap">
                <?php

                foreach ( typeLinkArray( ( $general[ 'socials' ] ?? array() ) ) as $key => $value ): ?>
                <a class="" href="<?php echo esc_url( $value ) ?>">
                    <div class=" d-flex justify-content-center align-items-center p-2 rounded-circle bg-secondary ">
                        <div class="w-24 h-24 ">
                            <img class="w-100" src="<?php echo get_the_image_url( 'social/' . $key . '.png' ) ?>">
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>