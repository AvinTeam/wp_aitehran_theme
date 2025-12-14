<section class="container-fluid bg-primary">
    <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center py-40 ">
        <div class="col-12 col-lg-9">
            <div class="swiper sliderSwiper w-100">
                <div class="swiper-wrapper  p-0">
                    <?php

                    foreach ( $items as $item ): ?>
                    <div class="swiper-slide ">
                        <div
                            class="d-flex flex-column justify-content-center align-items-center bg-black position-relative overflow-hidden rounded-65 ">
                            <a href="<?php echo $item[ "link" ] ?>">
                                <img src="<?php echo $item[ "image" ] ?>" alt="<?php echo $item[ "title" ] ?>"
                                    class="w-100 object-fit-cover" style="height: 503px;">
                            </a>
                            <div class="d-flex flex-column justify-content-center align-items-center row-gap-3 w-100 px-24 position-absolute bottom-0 opacity-75"
                                style="background-color: #2E3092; height: 105px;">
                                <a href="<?php echo $item[ "link" ] ?>"
                                    class="btn btn-link f-20 fw-bold w-100 text-start text-justify"><?php echo $item[ "title" ] ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- <div class="col-12 col-lg-3 d-flex flex-column justify-content-between p-2"> -->
        <div class="col-12 col-lg-3 d-flex flex-column justify-content-between p-2 gap-3"  style="height: 503px;">

            <a href="<?=  $panel ?>" class="h-100 w-100 d-flex flex-column bg-secondary  rounded-65 py-24">
                <div class="px-12   rounded-65 overflow-hidden ">

                    <img src="<?php echo get_the_image_url( 'panel.png' ) ?>"
                        class="w-100 h-120 object-fit-cover  rounded-65" alt="ثبت نام و ارسال اثر ">
                </div>
                <span class="text-white w-100 text-center opacity-75 f-32 fw-bold">
                    ثبت نام و ارسال اثر
                </span>

            </a>

            <a href="<?=  $academy ?>" class="h-100 w-100 d-flex flex-column bg-warning  rounded-65 py-24">
                <div class="px-12   rounded-65 overflow-hidden ">

                    <img src="<?php echo get_the_image_url( 'academy.png' ) ?>"
                        class="w-100 h-120 object-fit-cover  rounded-65" alt="آموزش">
                </div>
                <span class="text-secondary w-100 text-center opacity-75 f-32 fw-bold">
                    آموزش
                </span>

            </a>

        </div>
    </div>

</section>