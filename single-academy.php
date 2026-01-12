<?php

    use TAI\App\Controllers\Academy\AcademyController;

    get_header();

    $controller = new AcademyController();
?>
<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">
                <?php $controller->sidebar(); ?>
            </div>

            <div class="col-12 col-lg-8 px-2 ">
                <?php
                    if ( is_user_logged_in() ) {
                        $controller->content();
                    } else {
                        components( 'login' );
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();