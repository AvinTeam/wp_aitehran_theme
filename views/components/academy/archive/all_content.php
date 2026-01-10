<section class="w-100  d-flex flex-column justify-content-center align-items-center mb-2">


    <a href="<?php echo esc_url( $link ) ?>"
        class="btn btn-secondary rounded-32 text-center p-16 mb-4 fw-bold f-24" style="width: 390px;">
        <?php echo $name ?>
    </a>
    <div class="row row-cols-lg-3 row-cols-1 w-100 row-gap-1">

        <?php
        foreach ( $child as $row ): ?>
        <div class="p-1">
            <a href="<?php echo esc_url( $row[ "link" ] ) ?>"
                class="btn btn-primary rounded-32 text-center p-16 mb-4 fw-bold f-24  w-100 d-flex justify-content-center align-items-center">
                <?php echo $row[ "name" ] ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>