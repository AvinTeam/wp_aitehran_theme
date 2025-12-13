<section class="works mt-40 w-100">

    <div class="container">
        <div class="row row-gap-3">
            <div class="col-12 col-lg-6 d-flex justify-content-start align-items-center">
                <div class="d-flex flex-column row-gap-4 m-1">
                    <span class="f-24 text-primary-emphasis">خدمات زندگی با آیه ها</span>
                    <span class="f-32 fw-black text-primary"><?php echo $title ?></span>
                    <span class="f-20 text-primary-emphasis text-justify"><?php echo $description ?></span>
                </div>
            </div>
            <?php foreach ($works as $work): ?>
            <div class="col-12 col-lg-3 ">
                <div class="d-flex flex-column m-1 bg-white rounded-32 p-16 overflow-hidden shadow-lg "
                    style="height: 315px;">
                    <div class="d-flex flex-row justify-content-between  align-items-start">
                        <img src="<?php echo $work[ 'image' ] ?>" class="w-90 h-90 mb-16 rounded-24 overflow-hidden">
                        <div class="d-flex flex-column">
                            <?php if (! empty($work[ 'btn_title' ])): ?>
                            <a href="<?php echo esc_url($work[ 'link' ]) ?>" target="_blank" style="width: 134px;"
                                class="btn btn-primary rounded-circle px-24 py-12 f-14 text-nowrap"><?php echo $work[ 'btn_title' ] ?></a>
                            <?php endif; ?>

                            <?php if (! empty($work[ 'shortcode' ]) && ($clock[ $work[ 'shortcode' ] ] ?? 0)): ?>
                            <span style="width: 134px;"
                                class="d-flex flex-row justify-content-center align-items-center mt-1 rounded-circle px-24 py-12 f-14 text-nowrap text-wrap border border-1 border-primary text-primary show-timer-<?php echo $work[ 'shortcode' ] ?>">--:--:--</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="f-24 fw-bold text-primary mb-24 text-1-lines"><?php echo $work[ 'title' ] ?></span>
                    <span
                        class="f-16 text-primary-emphasis text-justify text-4-lines"><?php echo $work[ 'description' ] ?></span>
                </div>
            </div>

            <?php endforeach?>
        </div>
    </div>
    
</section>