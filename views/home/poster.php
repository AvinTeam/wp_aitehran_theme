<section class="posterSection container mt-40 rounded-40">
    <div class="d-flex flex-column justify-content-center align-items-center pt-64">
        <span class="f-32 fw-black text-white mb-40 col-12 col-lg-7 text-center"><?php echo $title ?></span>
        <span class="f-20 text-white text-justify mb-32 col-12 col-lg-7 text-center"><?php echo $description ?></span>
        <div class="col-12 col-lg-8 d-flex flex-column-reverse flex-lg-row justify-content-center align-items-center  ">
            <div class="text-center w-100">
                <img src="<?php echo get_the_image_url('mobile-poster.png') ?>" class="img-fluid">
            </div>
            <div class=" d-flex flex-column justify-content-center align-items-center gap-32 w-100">

                <a href="<?php echo $pwa ?>" target="_blank" class="btn btn-outline-light rounded-circle p-32">
                    <span class="f-20">نسخه وب اپلیکیشن (PWA)</span>
                </a>
                <a href="<?php echo $download ?>" target="_blank" class="btn btn-light rounded-circle p-32">
                    <span class="f-20 px-5">دانلود اپلیکیشن</span>
                </a>
            </div>
        </div>
    </div>
</section>