<section class="container-fluid bg-black">

    <div class="container d-flex flex-column justify-content-center align-items-center py-40 ">
        <span id="contact_us"
            class="py-12 w-280 text-center border border-1 border-white text-white fw-bold f-20 my-40 rounded-circle">
           ویدئو آموزشی
        </span>

        <div class="swiper videoSwiper w-100">
            <div class="swiper-wrapper">
                <?php

                foreach ( $items as $item ): ?>
                <div class="swiper-slide">
                       <div class="d-flex flex-column flex-row justify-content-center p-24"
                        style="background-color:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php echo $color; ?>;">
                        <a href="<?php echo $item[ "link" ] ?>"
                            class="p-lg-2 col-12 col-lg-8 d-flex justify-content-center align-items-center position-relative">
                            <img src="<?php echo $item[ "image" ] ?>" alt="<?php echo $item[ "title" ] ?>"
                                class="w-100 ">
                                <img src="<?php echo get_the_image_url( 'play.png' ) ?>" 
                                class="position-absolute top-50 start-50 translate-middle z-1 w-150 h-150">
                        </a>
                        <div class="p-lg-2 col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start row-gap-3">
                            <a href="<?php echo $item[ "link" ] ?>"
                                class="btn btn-link f-32 fw-bold w-100 text-start text-justify"><?php echo $item[ "title" ] ?></a>
                            <div class="text-white"><?php echo $item[ "content" ] ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>

</section>