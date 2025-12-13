<section class="px-2 px-lg-0">
    <div class="container mt-40 p-16 bg-media d-flex flex-column rounded-16 justify-content-center align-items-center ">
        <span class="f-32 text-primary fw-bold w-100 mb-16 text-center"><?php echo $title ?></span>
        <span class="f-20 text-primary-emphasis w-100 lh-lg text-center"><?php echo $description ?></span>
        <div
            class="d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-center w-100 mt-3 row-gap-2 row-gap-lg-0">
            <div class="d-flex flex-row justify-content-start align-items-center gap-12">
                <a href="<?php echo home_url(config('urls.blog')) ?>"
                    class="btn btn-outline-primary rounded-circle p-10 f-14 text-nowrap">اخبار و اطلاعیه</a>
            </div>
        </div>
    </div>
</section>