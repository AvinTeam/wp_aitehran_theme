<section class="w-100 d-flex flex-column justify-content-center align-items-center mb-2">

    <div class="row row-cols-lg-3 row-cols-1 w-100">

        <?php

                foreach ( $items ?? array() as $post ):
            ?>
        <div class="p-1">
            <div class="d-flex flex-column justify-content-center align-items-center bg-primary ">
                <a href="<?php echo $post[ "link" ] ?>">
                    <img src="<?php echo $post[ "image" ] ?>" alt="<?php echo $post[ "title" ] ?>"
                        class="w-100 h-150 object-fit-cover">
                </a>
                <div class="d-flex flex-column justify-content-center align-items-start row-gap-3 w-100 px-2 pb-24">
                    <a href="<?php echo $post[ "link" ] ?>"
                        class="post-title btn btn-link f-20 fw-bold w-100 text-start text-justify text-2-lines"><?php echo $post[ "title" ] ?></a>
                </div>
            </div>

        </div>

        <?php endforeach; ?>
    </div>
</section>