<section class="container mt-64 d-flex flex-column" id="banners">

    <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
    <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>
    <div class="row row-cols-1 row-cols-lg-2">
        <?php foreach ($banners as $banner): ?>
        <div class="p-3">
            <a class="" href="<?php echo esc_url($banner[ 'link' ]) ?>">
                <img class="overflow-hidden rounded-32 img-fluid" src="<?php echo esc_url($banner[ 'url' ]) ?>">
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>