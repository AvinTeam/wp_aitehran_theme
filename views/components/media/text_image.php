<?php if (isset($image) && !empty($image)): ?>
<div class="p-2" data-type="text_image">
    <div class="bg-media rounded-16 p-16 d-flex flex-column  justify-content-center align-items-center ">


        <a href="<?php echo $image ?? '' ?>" data-lightbox="text_image" data-title="<?php echo $campaign_title ?? '' ?>"
            class="w-100">
            <img src="<?php echo $image ?? '' ?>" alt="<?php echo $campaign_title ?? '' ?>"
                class="lightbox-image w-100 object-fit-cover rounded-12 mb-16">
        </a>

        <?php if (isset($campaign_link) && isset($campaign_title) && isset($surah_link) && isset($surah)): ?>

        <p class="text-1-lines text-primary text-start w-100"><?php echo $description ?? '' ?></p>
        <div class="d-flex flex-row justify-content-between align-items-center mt-16 w-100">
            <div class="d-flex flex-row justify-content-start align-items-center gap-1">

                <a href="<?php echo $campaign_link ?? '#' ?>"
                    class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap">پویش
                    <?php echo $campaign_title ?? '' ?></a>
                <a href="<?php echo $surah_link ?? '#' ?>"
                    class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap"><?php echo $surah ?? '' ?></a>
            </div>
            <a href="#" class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap">پوستر</a>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php endif; ?>