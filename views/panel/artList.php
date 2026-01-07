<?php

    $game = get_option( 'tai_game_settings', array() );
?>

<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column-reverse flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">
                <div
                    class="bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24 mb-3">
                    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
                        ثبت نام و ارسال اثر
                    </div>

                    <div>
                        <img src="<?php echo get_the_image_url( 'panel1.png' ) ?>" alt=""
                            class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
                    </div>
                </div>
                <?php view( 'panel/sidebar', $sidebarItems ); ?>
            </div>

            <div class="col-12 col-lg-8 px-2 ">

                <div class="w-100 d-flex flex-row justify-content-between align-items-center mb-32">

                    <a href="<?php echo home_url( "/panel/addTeem/" ) ?>"
                        class="btn btn-dark rounded-32 px-24 py-2 f-24 fw-bold">
                        بازگشت
                    </a>


                    <?php

                    if ( $pagination[ 'total_posts' ] < 10 && ( $game[ 'status' ] ?? false ) ): ?>
                    <a href="<?php echo home_url( "/panel/art-info" ) ?>"
                        class="btn btn-warning rounded-32 px-24 py-2 f-24 fw-bold">
                        ثبت اثر جدید
                    </a>
                    <?php endif; ?>

                </div>
                <?php getAlert(); ?>
                <section class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100  ">


                    <div class="alert alert-primary text-primary text-center" role="alert">
                        تعداد آثار قابل ثبت در هر قالب حداکثر ۵ اثر و در مجموع؛ حداکثر تعداد آثار قابل ثبت ۱۰ اثر
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">

                        <?php

                            if ( count( $items ) == 0 ) {
                                echo '<div class="alert alert-light text-center w-100" role="alert"> شما اثری ثبت نکرده اید</div>';
                            } else {}

                        ?>





                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">عنوان</th>
                                    <th scope="col">قالب اثر</th>
                                    <th scope="col">کد رهگیری</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $m = 1;

                                foreach ( $items as $item ): ?>
                                <tr>
                                    <th scope="row">
                                        <span class="d-flex align-items-center h-60">
                                            <?php echo $m ?>
                                    </th>
                                    </span>
                                    <td>
                                        <span class="d-flex align-items-center h-60">
                                            <?php echo $item[ 'title' ] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center h-60">
                                            <?php echo $item[ 'format' ] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center h-60">
                                            <?php echo $item[ 'tracking_code' ] ?>
                                        </span>
                                    </td>
                                    <td>
                                         <span class="d-flex gap-3 align-items-center h-60">
                                        <a href="<?php echo $item[ 'link' ] ?>" class="btn btn-info">ویرایش</a>
                                        <button type="button" id="delTeem"
                                            data-username="<?php echo $teem[ 'username' ] ?>"
                                            class="btn btn-danger">حذف</button>
                                            
                                        </span>
                                    </td>
                                </tr>

                                <?php ++$m;endforeach; ?>
                            </tbody>
                        </table>













                        <!-- <a href="<?php echo $item[ 'link' ] ?>"
                            class="col-form-label text-nowrap p-2 fw-bold f-32 text-primary w-100 d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <span class="text-secondary me-2"><?php echo $m ?>-</span><?php echo $item[ 'title' ] ?>
                            </div>
                            <span style="color: #5A5A5A; font-size: 14px;">
                                <?php echo sprintf( "قالب اثر : %s", $item[ 'format' ] ) ?>

                            </span>




                        </a>

                        <hr class="w-100"> -->





                    </div>





                </section>
            </div>
        </div>
    </div>
</section>