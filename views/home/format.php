<section class="container-fluid" style="background-color: #24257E;">

    <div class="container d-flex flex-row flex-wrap justify-content-between align-items-center gap-2 py-40 row-gap-3">

        <?php foreach ( $formats as $format ): ?>
            <img src="<?php echo get_the_image_url( 'formats/' . $format ) ?>" class="h-48">
        <?php endforeach; ?>

    </div>

</section>