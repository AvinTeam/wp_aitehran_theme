<?php get_header(); ?>


<div class="container">

    <div class="bg-secondary rounded-70 d-flex flex-column flex-lg-row justify-content-center align-items-center m-40 p-40 row-gap-3">

        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
            <img class="w-280" src="<?php echo get_the_image_url( '404.png' ) ?>" alt="404">
        </div>

        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center row-gap-3">

            <h2 class="text-white">یه مشکلی تووکاره !!!</h2>
            <h4 class="text-white">باید صفحه دیگه ای رو بررسی کنید</h4>
            <a  href="<?php echo home_url( '/' )?>" class="btn btn-warning btn-lg rounded-40 mt-64">ورود به صفحه نخست</a>

        </div>
    </div>
</div>

<?php
get_footer(); ?>