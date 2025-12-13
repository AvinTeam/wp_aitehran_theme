<section id="hero-news" class="px-2 px-lg-0">
    <div
        class="container mt-40 p-16 d-flex flex-lg-row flex-column rounded-32 justify-content-start align-items-center shadow gap-24 ">
        <div class="rounded-24 w-280 h-280 object-fit-cover">
            <img class="rounded-24 w-280 h-280 object-fit-cover" src="<?php echo esc_url( $image ); ?>"
                alt="<?php echo $title; ?>">
        </div>
        <div class="d-flex flex-column justify-content-between align-items-start gap-56">
            <div class="d-flex flex-column justify-content-center align-items-start gap-1">
                <span class="text-primary-emphasis fw-bold"><?php echo $title; ?></span>
                <span class="text-primary-emphasis fw-bold"><?php echo $side; ?></span>
            </div>
            <p class="f-20 text-primary text-justify text-2-lines ">
                <?php echo $description; ?>
            </p>
        </div>
    </div>
</section>