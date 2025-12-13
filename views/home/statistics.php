<section id="statistics" class="statistics container mt-64">
    <div class="row row-cols-2 row-cols-lg-3">
        <?php  
        foreach ( $list as $item ): ?>
        <div class="p-2">
            <a
            <?php if(!empty($item[ 'link' ])): ?>
                 href="<?php echo esc_url($item[ 'link' ] )?>"
                 target="_blank"
            <?php endif; ?>
                class="w-100 d-flex flex-lg-row flex-column-reverse justify-content-between align-items-lg-center align-items-start p-24 border border-light-subtle rounded-32 ">
                <div class="d-flex flex-column">
                    <span
                        class="f-28 fw-bold text-primary number-wrapper"><?php echo get_counter( $item[ 'number' ] ) ?></span>
                    <span class="f-20 text-primary-emphasis"><?php echo $item[ 'title' ] ?></span>
                </div>
                <img src="<?php echo $item[ 'image_url' ] ?>" alt="<?php echo $item[ 'title' ] ?>"
                    class="object-fit-cover">
            </a>
        </div>

        <?php endforeach; ?>
</section>