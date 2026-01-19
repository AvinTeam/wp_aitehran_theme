<section class="w-100">

    <!-- <img src="<?php echo post_image_url() ?>" alt="<?php the_title(); ?>" class="w-100 object-fit-cover" style="max-height: 480px;"> -->

    <h1 class="f-52 text-justify text-black"><?php the_title(); ?></h1>

    <div class="f-24 fw-light text-justify mt-32">
        <?php the_content(); ?>
    </div>
</section>