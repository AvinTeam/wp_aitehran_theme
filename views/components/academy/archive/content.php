<section class="w-100  d-flex flex-column justify-content-center align-items-center mb-2">


    <div class="bg-secondary rounded-32 text-white text-center p-16 mb-4 fw-bold f-24" style="width: 390px;">
        <?php echo $title ?>
    </div>
    <div class="row row-cols-lg-3 row-cols-1  w-100">

        <?php

            foreach ( $posts as $post ):
        ?>
        <div class="p-1">
            <div class="d-flex flex-column justify-content-center align-items-center
                <?php echo $post[ "is_see" ] ? "bg-primary" : "bg-black" ?> ">
                <a href="<?php echo $post[ "link" ] ?>">
                    <img src="<?php echo $post[ "image" ] ?>" alt="<?php echo $post[ "title" ] ?>"
                        class="w-100 h-150 object-fit-cover">
                </a>
                <div class="d-flex flex-column justify-content-center align-items-start row-gap-3 w-100 px-24 pb-24">


                    <div class="d-flex flex-row justify-content-between align-items-center w-100 mt-3">
                        <span class="text-secondary f-16 w-100 text-nowrap"><?php echo $post[ "time" ] ?></span>
                        <span class="text-secondary f-16 w-100 text-nowrap text-end">
                            <?php echo $post[ "is_see" ] ? "مشاهده شده" : "مشاهده نشده"; ?>
                        </span>
                    </div>



                    <a href="<?php echo $post[ "link" ] ?>"
                        class="btn btn-link f-20 fw-bold w-100 text-start text-justify text-2-lines"><?php echo $post[ "title" ] ?></a>
                </div>
            </div>

        </div>





        <?php endforeach; ?>



    </div>
</section>