<?php if (isset($home_page)): ?>

<div class="p-2" data-type="poster">
    <div class="d-flex flex-column justify-content-center align-items-center ">

        <a href="<?php echo $image ?? '' ?>" data-lightbox="gallery" data-title="<?php echo $campaign_title ?? '' ?>"
            class="w-100">
            <img src="<?php echo $image ?? '' ?>" alt="<?php echo $campaign_title ?? '' ?>"
                class="lightbox-image w-100 object-fit-cover rounded-12 mb-16">
        </a>
        <a href="<?php echo $surah_link ?? '#' ?>"
            class="btn text-white text-nowrap text-1-lines p-0 w-100 text-center"><?php echo $title ?? '' ?></a>

        <a href="<?php echo $campaign_link ?? '#' ?>"
            class="btn btn-outline-light rounded-circle px-2 py-1 f-14 text-nowrap f-10 lh-1 mt-16 opacity-75">پویش
            <?php echo $campaign_title ?? '' ?></a>


    </div>
</div>
<?php else: ?>

<div class="p-2" data-type="poster">
    <div class="bg-media rounded-16 p-16 d-flex flex-column justify-content-center align-items-center ">


        <a href="<?php echo $image ?? '' ?>" data-lightbox="gallery" data-title="<?php echo $campaign_title ?? '' ?>"
            class="w-100">
            <img src="<?php echo $image ?? '' ?>" alt="<?php echo $campaign_title ?? '' ?>"
                class="lightbox-image w-100 object-fit-cover rounded-12 mb-16">
        </a>

        <?php if (isset($campaign_link) && isset($campaign_title) && isset($surah_link) && isset($surah)): ?>
        <div class="d-flex flex-row justify-content-between align-items-center mt-16 w-100">
            <div class="d-flex flex-row justify-content-start align-items-center gap-1">

                <a href="<?php echo $campaign_link ?? '#' ?>"
                    class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap f-10 lh-1">پویش
                    <?php echo $campaign_title ?? '' ?></a>
                <a href="<?php echo $surah_link ?? '#' ?>"
                    class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap f-10 lh-1"><?php echo $surah ?? '' ?></a>
            </div>
            <a href="#" class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap f-10 lh-1">پوستر</a>
        </div>
        <?php endif; ?>

    </div>
</div>
<?php endif; ?>