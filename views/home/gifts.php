<section class="container mt-40">

    <div class="row">
        <div class="col-3 d-none d-lg-flex justify-content-center align-items-center">
            <img class="img-fluid" src="<?php echo get_the_image_url('gift.png') ?>">
        </div>
        <div class="col-12 col-lg-9 d-flex flex-column">
            <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
            <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-between align-items-center gap-16 ">
                    <div class="d-flex flex-row justify-content-start gap-16 align-items-center overflow-x-auto py-3 scroll-container">
                        <button type="button" data-id="all"
                            class="btn btn-primary tab-btn rounded-circle px-12 py-8 f-20 text-nowrap">همه پویش
                            ها</button>
                        <?php foreach ($campaign_list as $campaign): ?>
                        <button type="button" data-id="<?php echo $campaign[ 'id' ] ?>"
                            class="btn btn-outline-primary-subtle tab-btn rounded-circle px-12 py-8 f-20 text-nowrap">پویش
                            <?php echo $campaign[ 'name' ] ?></button>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo home_url('gifts') ?>" target="_blank"
                        class="btn btn-primary rounded-circle px-12 py-8 f-20 text-nowrap d-none d-lg-block">مشاهده
                        بیشتر</a>
                </div>
                <div class="swiper giftSwiper w-100">
                    <div class="swiper-wrapper">
                        <?php foreach ($gift_list as $gift): ?>

                        <div style="width: 233px !important; height: 296.6px; "
                            data-id="campaign_<?php echo $gift[ 'campaign_id' ] ?>"
                            class="swiper-slide p-12 overflow-hidden d-flex flex-column justify-content-center align-items-center rounded-dome border border-1 border-gold">
                            <img class="rounded-dome object-fit-cover w-100" style="height: 190px;"
                                src="<?php echo $gift[ 'image' ] ?? '' ?>">
                            <span
                                class="f-20 text-primary text-1-lines mb-16 text-nowrap mt-1"><?php echo $gift[ 'title' ] ?? '' ?></span>

                            <a href="<?php echo $gift[ 'campaign_url' ] ?>" target="_blank"
                                class="btn btn-outline-primary rounded-circle px-8 py-1 f-14 text-nowrap">پویش
                                <?php echo $gift[ 'campaign_title' ] ?></a>
                        </div>

                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="text-center mt-2 mb-3">
                    <a href="https://zendegibaayeha.ir/pay/" target="_blank"
                        class="btn btn-outline-primary px-12 py-8 f-20 text-nowrap">مشارکت در هدایای پویش زندگی با آیه
                        ها</a>
                </div>
                <a href="<?php echo home_url('gifts') ?>" target="_blank"
                    class="btn btn-primary rounded-circle px-12 py-8 f-20 text-nowrap d-lg-none">مشاهده بیشتر</a>
            </div>
        </div>
    </div>
</section>