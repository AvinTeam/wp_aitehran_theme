<div class="p-2">
    <div class="d-flex flex-column bg-white p-16 rounded-32 shadow-lg">
        <div class="d-flex flex-row justify-content-start align-items-center gap-24 mb-24">
            <a href="<?php echo $link ?? '' ?>">
                <img src="<?php echo $image ?? '' ?>" class="w-90 h-90 rounded-24 object-fit-cover"
                    alt="<?php echo $title ?? '' ?>">
            </a>
            <div class="d-flex flex-column gap-1">
                <a href="<?php echo $link ?? '' ?>"
                    class="f-16 fw-bold btn btn-link text-2-lines p-0 lh-lg text-justify" style="color: #080A4FB2 !important;"><?php echo $title ?? '' ?></a>
                <span class="f-16 fw-bold text-primary-emphasis"><?php echo $side ?? '' ?></span>
            </div>
        </div>
        <p class="f-20 text-justify text-primary p-0 m-0 text-5-lines w-100 h-150 ">
            <?php echo $content ?? '' ?></p>
        <div class="d-flex flex-row justify-content-end mt-24 ">
            <a href="<?php echo $link ?? '' ?>" class="btn btn-link d-flex flex-row justify-content-center align-items-center gap-2">
                <span>مشاهده بیشتر</span>
                <img src="<?php echo get_the_image_url('more-circle.png') ?>" class="w-24 h-24">
            </a>
        </div>
    </div>
</div>