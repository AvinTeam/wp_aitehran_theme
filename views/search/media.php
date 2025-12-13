<div class="px-2 px-lg-0">
    <section class="container mt-64">
        <div class="row mediaItem w-100 row-cols-1 row-cols-lg-3">
            <?php

            foreach ( $media_list as $item ) {
                components( 'media/' . $mediaType, $item );
            }

        ?>
        </div>
    </section>
</div>