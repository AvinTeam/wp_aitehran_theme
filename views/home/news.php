<section class="pt-40 w-100" style="background: #F5F5F8;">
    <div class="container pt-64 mb-40 pb-40">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
            <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>
            <div class="row row-cols-1 row-cols-lg-3">
                <?php foreach ($news as $item) {components('news', $item);}?>
            </div>
            <div class="text-center mt-24">
                <a href="<?php echo home_url(config('urls.blog')) ?>" class="btn btn-light f-20 rounded-circle px-12 py-8" style="color: #010329 !important;">مشاهده بیشتر اخبار</a>
            </div>
        </div>
    </div>
</section>