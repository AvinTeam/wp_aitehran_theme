<?php
    get_header();
?>
<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">




                <div
                    class="bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24 mb-3">
                    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
                        <?php the_title(); ?>
                    </div>

                    <div>
                        <img src="<?php echo  get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt=""
                            class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
                    </div>
                </div>

                <div
                    class="position-sticky top-0 bg-gray d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">

                    <div class="bg-secondary rounded-32 w-100 text-white text-center p-16 mb-4">
                        آخرین اخبار
                    </div>

                    <div class="w-100 d-flex flex-column justify-content-center align-items-center row-gap-3">

                        <?php


                                $args = array(
                                        'post_type'      => 'post',
                                        'category_name'  => "news",
                                        'posts_per_page' => 4,
                                        'post_status'    => 'publish',
                                        'orderby'        => 'rand',

                                    );

                            $query = new WP_Query( $args );

                            if ( $query->have_posts() ):

                                while ( $query->have_posts() ): $query->the_post(); ?>
                        <div
                            class="w-100 d-flex flex-column justify-content-center align-items-center row-gap-3 bg-primary p-10">
                                      <?php
                                 if ( post_image_url() ) {?>
                            <a href="<?php echo get_permalink() ?>"> <img src="<?php echo post_image_url() ?>"
                                    alt="<?php echo get_the_title() ?>" class="w-100 h-120 object-fit-cover"> </a>
                            <?php }    ?>
                            <a href="<?php echo get_permalink() ?>"
                                class="btn btn-link f-20 fw-bold "><?php echo  get_the_title()?></a>

                        </div>
                        <?php
                                endwhile;

                                wp_reset_postdata();
                            endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 px-2 ">
                <section class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

                    <?php the_content(); ?>
                </section>
            </div>
        </div>
    </div>
</section>
<?php get_footer();