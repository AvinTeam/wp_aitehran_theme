<?php
    use TAI\App\Controllers\Post\PostController;

    get_header();

    $controller = new PostController();
?>
<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column-reverse flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-3 d-flex flex-column position-relative px-2">
                <?php $controller->sidebar(); ?>
            </div>

            <div class="col-12 col-lg-9 px-2 ">
                <?php $controller->content(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();