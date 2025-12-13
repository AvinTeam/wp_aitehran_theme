<section class="container mt-40">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
        <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>

        <div class="swiper supportersSwiper w-100">
            <div class="swiper-wrapper">
                <?php foreach ($images as $image): ?>
                <div class="swiper-slide">
                    <img loading="lazy" src="<?php echo $image?>" class="card-img-top rounded object-fit-cover" style="width: 100px !important; height: 100px;">
                </div>
                <?php endforeach?>
            </div>
        </div>
    </div>
</section>