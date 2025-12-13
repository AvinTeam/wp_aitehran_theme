<section class="container mt-40">

    <div class="d-flex flex-column">

        <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
        <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>
        <div class=" row">

            <div class="col-12 col-lg-9 d-flex flex-column">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-between align-items-center gap-16 ">
                        <div
                            class="d-flex flex-row justify-content-start gap-16 align-items-center overflow-x-auto py-3 scroll-container">
                            <button type="button" data-id="all"
                                class="btn btn-primary tab-btn-winner rounded-circle px-12 py-8 f-20 text-nowrap">همه
                                پویش
                                ها</button>
                            <?php foreach ($campaign_list as $campaign): ?>
                            <button type="button" data-id="<?php echo $campaign[ 'id' ] ?>"
                                class="btn btn-outline-primary-subtle tab-btn-winner rounded-circle px-12 py-8 f-20 text-nowrap">پویش
                                <?php echo $campaign[ 'name' ] ?></button>

                            <?php endforeach; ?>
                        </div>
                        <a href="<?php echo home_url('winners') ?>" target="_blank"
                            class="btn btn-primary rounded-circle px-12 py-8 f-20 text-nowrap d-none d-lg-block">مشاهده
                            بیشتر</a>
                    </div>
                    <div class="swiper winnerSwiper w-100">
                        <div class="swiper-wrapper">
                            <?php foreach ($winner_list as $winner): ?>
                            <div style="width: 215px !important; height: 373px;"
                                data-id="campaign_<?php echo $winner[ 'campaign_id' ] ?>"
                                class="swiper-slide p-12 overflow-hidden d-flex flex-column justify-content-center align-items-center rounded-dome border border-1 border-gold">
                                <img class="rounded-dome object-fit-cover w-100" src="<?php echo $winner[ 'image' ] ?>"
                                    style="height: 178px;">

                                <div class="d-flex flex-row justify-content-center align-items-center w-100 mt-8 ">
                                    <span
                                        class="f-20 text-primary text-nowrap w-100 text-1-lines text-center"><?php echo $winner[ 'title' ] ?></span>
                                </div>

                                <div
                                    class="mt-2 d-flex flex-column justify-content-center align-items-center bg-gold-gradient p-8 rounded-3 w-100">
                                    <span
                                        class="f-20 text-white mb-8 text-1-lines w-100 text-center"><?php echo $winner[ 'name' ] ?></span>
                                    <span class="f-20 text-white"><?php echo $winner[ 'mobile' ] ?></span>
                                </div>

                                <a href="<?php echo $winner[ 'campaign_url' ] ?>" target="_blank"
                                    class="btn btn-outline-primary rounded-circle px-8 py-1 f-14 text-nowrap  mt-8">پویش
                                    <?php echo $winner[ 'campaign_title' ] ?></a>


                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <a href="<?php echo home_url('winners') ?>" target="_blank"
                        class="btn btn-primary rounded-circle px-12 py-8 f-20 text-nowrap d-lg-none">مشاهده بیشتر</a>
                </div>
            </div>
            <div class="col-3 d-none d-lg-flex justify-content-center align-items-center">
                <img class="img-fluid" src="<?php echo get_the_image_url('winner.png') ?>">
            </div>
        </div>
    </div>
</section>