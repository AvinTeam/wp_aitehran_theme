<?php

    use TAI\App\Controllers\Post\PostController;

    add_filter( 'nav_menu_css_class', function ( $classes, $item, $args ) {

        if ( "/" . config( 'urls.blog' ) == $item->url ) {
            $classes[  ] = "current-menu-item";
            $classes[  ] = "active";
        }

        return $classes;
    }, 11, 3 );

    get_header();

    $controller = new PostController();

    $controller->header();
    $controller->hero();
?>


<section class="px-2 px-lg-0 ">
    <div class=" mt-40 container">
        <div class="row justify-content-between row-gap-4 row-gap-lg-0">

            <div class="col-12 col-lg-3 d-flex flex-column position-relative">

                <?php
                    view( 'post/single/sidebar' );
                ?>

            </div>

            <div class="col-12 col-lg-9 ">
                <?php
                    $controller->content();
                ?>


            </div>

        </div>
    </div>
</section>


<?php
    $controller->list();
?>

<button type="button"
    class="d-block d-lg-none btn bg-body rounded-circle px-8 py-2 f-14 text-nowrap position-fixed z-3 shareLink"
    data-shareLink="<?php echo get_the_permalink() ?>" style="right: 20px; bottom: 33px;">
    <img src="<?php echo get_the_image_url( 'share.png' ) ?>" class="w-32 h-32 object-fit-cover" alt="share">
</button>

<?php get_footer();