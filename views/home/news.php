<section class="container-fluid bg-primary">

    <div class="container d-flex flex-column justify-content-center align-items-center py-40 ">
        <span id="contact_us"
            class="py-12 w-280 text-center border border-1 border-white text-white fw-bold f-20 my-40 rounded-circle">
            <?php echo $title ?>
        </span>

        <div class="swiper newsSwiper w-100">
            <div class="swiper-wrapper">
                <?php

                foreach ( $items as $item ): ?>
                <div class="swiper-slide">
                    <div class="d-flex flex-row justify-content-center p-24"
                        style="background-color:                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php echo $color; ?>;">
                        <a href="<?php echo $item[ "link" ] ?>"
                            class="p-2 col-6 d-flex justify-content-center align-items-center">
                            <img src="<?php echo $item[ "image" ] ?>" alt="<?php echo $item[ "title" ] ?>"
                                class="w-100 h-120 object-fit-contain">
                        </a>
                        <div class="p-2 col-6 d-flex flex-column justify-content-center align-items-start row-gap-3">
                            <span class="text-secondary f-16 w-100 text-start"><?php echo $item[ "date" ] ?></span>
                            <a href="<?php echo $item[ "link" ] ?>"
                                class="text-primary f-20 fw-bold w-100 text-start text-justify"><?php echo $item[ "title" ] ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

</section>