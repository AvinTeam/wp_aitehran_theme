<section class="container-fluid" style="background-color: #24257E;">
    <div class="container d-flex flex-row flex-wrap justify-content-between align-items-center gap-2 py-40 row-gap-3">
        <?php foreach ( $formats as $format ): ?>
            <a href="<?php echo esc_url($format["link"] )?>" class="h-48"><img src="<?php echo $format["url"] ?>" class="h-48"></a>
        <?php endforeach; ?>
    </div>
</section>