<section class=" heroSection container mt-40 rounded-40 position-relative">
    <div class=" row justify-content-center">
        <div class="col-12 col-lg-7 d-flex flex-column justify-content-center align-items-center px-40">
            <h1 class="f-32 fw-black text-white text-justify lh-lg mt-5 mt-lg-0 "><?php echo $title ?></h1>
            <h3 class="f-20 text-white text-justify mt-32 lh-lg"><?php echo $description ?></h3>
            <div class=" d-none d-lg-flex flex-column flex-lg-row justify-content-center align-items-center gap-32 mt-64">
                <a href="<?php echo $download ?>" target="_blank" class="btn btn-light rounded-circle p-32">
                    <span class="f-20 px-3">دانلود اپلیکیشن</span>
                </a>

                <a href="<?php echo $pwa ?>" target="_blank" class="btn btn-outline-light rounded-circle p-32">
                    <span class="f-20">نسخه وب اپلیکیشن (PWA)</span>
                </a>

            </div>
        </div>
        <div class="col-12 col-lg-5 d-flex justify-content-center align-items-center ">
            <img class="mobileImage" src="<?php echo get_the_image_url('mobile.png') ?>">
        </div>

        <div class="col-12  d-lg-none d-flex flex-column justify-content-center align-items-center">

            <div class="col-12 d-flex flex-column flex-lg-row justify-content-center align-items-center gap-32">
                <a href="<?php echo $download ?>" target="_blank" class="btn btn-light rounded-circle p-32">
                    <span class="f-20 px-3">دانلود اپلیکیشن</span>
                </a>

                <a href="<?php echo $pwa ?>" target="_blank" class="btn btn-outline-light rounded-circle p-32">
                    <span class="f-20">نسخه وب اپلیکیشن (PWA)</span>
                </a>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-12 text-center">
            <img class="goto-btn cursor-pointer" data-goto="statistics"
                src="<?php echo get_the_image_url('bottom-hero.png') ?>">
        </div>
    </div>

</section>