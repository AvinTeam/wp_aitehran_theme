<section class="container-fluid bg-primary">

    <div class="container d-flex flex-column justify-content-center align-items-center py-40 ">
        <span id="contact_us"
            class="py-12 w-280 text-center border border-1 border-white text-white fw-bold f-20 my-40 rounded-circle">
            گالری تصاویر
        </span>

        <div class="swiper gallerySwiper w-100">
            <div class="swiper-wrapper">
                <?php

                foreach ( $items as $item ): ?>
                <div class="swiper-slide">
                    <div class="d-flex flex-column justify-content-center align-items-center bg-black">
                        <a href="<?php echo $item[ "link" ] ?>">
                            <img src="<?php echo $item[ "image" ] ?>" alt="<?php echo $item[ "title" ] ?>"
                                class="w-100 h-255 object-fit-contain">
                        </a>
                        <div class="d-flex flex-column justify-content-center align-items-start row-gap-3 w-100 px-24 pb-24">
                            <span class="btn text-secondary f-16 w-100 text-start"><?php echo $item[ "date" ] ?></span>
                            <a href="<?php echo $item[ "link" ] ?>"
                                class="btn btn-link f-20 fw-bold w-100 text-start text-justify"><?php echo $item[ "title" ] ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>









        <?php
        //foreach ( $items as $item ): ?>
        <!-- <div class="swiper-slide">
                    <img loading="lazy" src="<?php echo $image ?>" class="card-img-top rounded object-fit-cover" style="width: 100px !important; height: 100px;">
                </div> -->
        <?php //endforeach?>






    </div>

</section>