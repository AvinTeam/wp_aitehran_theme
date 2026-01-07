<div
    class=" bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">


    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
       جست و جو
    </div>

    <div>
        <img src="<?php echo get_the_image_url( 'blog.png' ) ?>" alt="" class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
    </div>





</div>

<div
    class=" bg-gray d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">


    <div class="bg-secondary rounded-32 w-100 text-white text-center p-16 mb-4 fw-bold f-24">
        آخرین اخبار
    </div>

    <div class="w-100 d-flex flex-column justify-content-center align-items-center row-gap-3">

        <?php

        foreach ( $items as $item ): ?>

        <div class="w-100 d-flex flex-column justify-content-center align-items-center row-gap-3 bg-primary p-10">
            <a href="<?php echo $item[ 'link' ] ?>"> <img src="<?php echo $item[ 'image' ] ?>" alt="<?php echo $item[ 'title' ] ?>" class="w-100 h-120 object-fit-cover"> </a>
            <a href="<?php echo $item[ 'link' ] ?>" class="btn btn-link f-20 fw-bold "><?php echo $item[ 'title' ] ?></a>

        </div>
        <?php endforeach; ?>
    </div>




</div>