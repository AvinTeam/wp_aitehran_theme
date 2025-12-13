<section class="mediaSection mt-40">

    <div class=" container">

        <div class="d-flex flex-column justify-content-center align-items-center pt-64 pb-40">
            <span class="f-32 fw-black text-white mb-40 col-12 col-lg-7 text-center"><?php echo $title ?></span>
            <span
                class="f-20 text-white text-justify mb-32 col-12 col-lg-7 text-center"><?php echo $description ?></span>

            <div class="d-flex flex-row justify-content-between align-items-center gap-16 w-100 ">
                <div class="d-flex flex-row justify-content-start gap-16 align-items-center overflow-x-auto py-3">
                    <?php foreach ($media_types as $key => $value): ?>
                    <button type="button" data-type="<?php echo $key ?>"
                        class="btn btn-outline-light media-tab-btn rounded-circle px-12 py-8 f-20 text-nowrap"><?php echo $value ?></button>

                    <?php endforeach; ?>
                </div>
                <a href="<?php echo home_url(config('urls.medias')) ?>" target="_blank"
                    class="btn btn-light rounded-circle px-12 py-8 f-20 text-nowrap d-none d-lg-block">مشاهده بیشتر</a>
            </div>


            <?php foreach ($media_list as $key => $media): ?>

            <div id="<?php echo $key ?>" class="d-none mediaItem swiper<?php echo $media[ 'class' ] ?> w-100">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($media[ 'items' ] ?? [  ] as $item): ?>
                    <div class="swiper-slide">

                        <?php components('media/' . $key, $item); ?>


                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <?php endforeach; ?>


















            <a href="<?php echo home_url(config('urls.medias')) ?>" target="_blank"
                class="btn btn-light rounded-circle px-12 py-8 f-20 text-nowrap d-lg-none">مشاهده بیشتر</a>
        </div>
    </div>
</section>