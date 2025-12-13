<section class="mt-40 w-100" >
    <div class="container pt-64 mb-40 pb-40">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
            <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>
            <div class="row row-cols-1 row-cols-lg-3">
                <?php foreach ($newsList as $item) {components('news', $item);}?>
            </div>
        </div>
    </div>
</section>