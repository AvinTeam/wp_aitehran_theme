<?php

    use TAI\App\Controllers\Blog\BlogController;

    $controller = new BlogController( ( $_GET ?? array() ) );

    get_header();

?>
<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2 row-gap-3">
                <?php $controller->sidebar_archive( get_the_archive_title() ); ?>
            </div>

            <div class="col-12 col-lg-8 px-2 h-auto ">

                <?php components( 'description',
                    array( "description" => get_the_archive_description() ) ); ?>

                <div class="bg-gray w-100  rounded-65 pt-64 px-40 pb-40 ">


                    <?php $controller->archive(); ?>
                    <?php $controller->pagination(); ?>
                </div>
            </div>


        </div>
    </div>
    </div>
</section>
<?php get_footer();