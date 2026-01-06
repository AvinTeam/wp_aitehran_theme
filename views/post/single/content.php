<?php
      if ( is_user_logged_in() ) {
            $user_meta = get_user_meta( get_current_user_id(), "post_see", true );

            $user_meta = is_array( $user_meta ) ? $user_meta : array();

            if ( ! in_array( get_the_ID(), $user_meta ) ) {
                $user_meta[  ] = get_the_ID();
                update_user_meta( get_current_user_id(), "post_see", $user_meta );
            }
        }

?>

<section class="w-100">

    <img src="<?php echo post_image_url() ?>" alt="<?php the_title(); ?>" class="w-100 object-fit-cover" style="max-height: 480px;">

    <h1 class="f-52 text-justify text-black"><?php the_title(); ?></h1>

    <div class="f-24 fw-light text-justify mt-32">
        <?php the_content(); ?>
    </div>
</section>