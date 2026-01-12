<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">
                <div
                    class="bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">


                    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
                        ثبت نام و ارسال اثر
                    </div>

                    <div>
                        <img src="<?php echo get_the_image_url( 'panel1.png' ) ?>" alt=""
                            class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 px-2 ">
                <?php getAlert(); ?>

                <div class="w-100 d-flex flex-row justify-content-end align-items-center mb-32">

                    <!-- <a href="<?php echo home_url( "/panel" ) ?>"
                        class="btn btn-dark rounded-32 px-24 py-2 f-24 fw-bold">
                        بازگشت
                    </a> -->

                    <a href="<?php echo home_url( "/panel/artList" ) ?>" class="btn btn-warning rounded-32 px-24 py-2 f-24 fw-bold
                        <?php echo $btn_continue ?> ">
                        مرحله بعد
                    </a>
                </div>

                <section id="addTeemForm" class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">
                    <div class="alert alert-primary text-primary text-center" role="alert">
                        حداکثر تعداد اعضای تیم 4 تفر می باشد
                    </div>

                    <?php
                        $m = 1;

                    if ( $teems ): ?>

                    <h2>لیست اعضا</h2>
                    <?php

                    foreach ( $teems as $teem ): ?>

                    <div id="alert" class="alert alert-light my-0" role="alert">
                        <div class="d-flex flex-wrap justify-content-between align-items-start align-items-lg-center  row-gap-2">
                            <div>
                                <span class="text-secondary"><?php echo $m ?>-</span>
                                <span class=""><?php echo $teem[ 'name' ] ?></span>
                            </div>
                            <span class=""><?php echo $teem[ 'nationalCode' ] ?></span>
                            <div>
                                <a href="<?php echo home_url( '/panel/addTeem/?teem=' . $teem[ 'username' ] ) ?>"
                                    class="btn btn-info">ویرایش</a>
                                <button type="button" id="delTeem" data-username="<?php echo $teem[ 'username' ] ?>"
                                    class="btn btn-danger">حذف</button>
                            </div>
                        </div>

                    </div>
                    <?php ++$m;endforeach; ?>

                    <?php endif; ?>

                    <?php

                    if ( $m <= 4 || ( isset( $_GET[ 'teem' ] ) && ! empty( $_GET[ 'teem' ] ) ) ): ?>


                    <?php wp_nonce_field( config( 'app.key' ) . '_addTeemForm_' . get_current_user_id() ); ?>

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="fullName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام و نام خانوادگی<span class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="fullName" value="<?php echo $fullName ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 only-fa">
                        </div>
                    </div>

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="parent" class="col-form-label text-nowrap p-2 f-24 fw-bold only-fa">نام
                                پدر :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="parent" value="<?php echo $parent ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="nationalCode" class="col-form-label text-nowrap p-2 f-24 fw-bold">کد ملی<span
                                    class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="nationalCode" value="<?php echo $nationalCode ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr onlyNumbersInput"
                                maxlength="10" inputmode="numeric" pattern="\d*">

                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="birthday" class="col-form-label text-nowrap p-2 f-24 fw-bold">تاریخ تولد<span
                                    class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">

                            <input id="birthday" type="text"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr" data-jdp=""
                                data-jdp-only-date="" data-jdp-max-date="today" value="<?php echo $birthday ?>">
                        </div>
                    </div>

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="edu" class="col-form-label text-nowrap p-2 f-24 fw-bold">مدرک
                                تحصیلی :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="edu" value="<?php echo $edu ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 only-fa">
                        </div>
                    </div>
                    <input type="hidden" id="username"
                        value="<?php echo( isset( $_GET[ 'teem' ] ) && ! empty( $_GET[ 'teem' ] ) ) ? $_GET[ 'teem' ] : 0 ?>">






                    <?php endif; ?>
                </section>
                <?php

                if ( $m <= 4 || ( isset( $_GET[ 'teem' ] ) && ! empty( $_GET[ 'teem' ] ) ) ): ?>

                <div class="w-100 d-flex flex-row justify-content-center align-items-center mt-32">
                    <button type="button" id="btnAddTeem" class="btn btn-warning rounded-32 w-75 p-2 f-24 fw-bold mt ">
                        ثبت
                    </button>
                </div>


                <?php endif; ?>


            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="modalDelTeem" tabindex="-1" aria-labelledby="modalDelTeemLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDelTeemLabel">حذف هم تیمی</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                آیا مطمئن هستید که میخواهید هم تیمی خود را حذف کنید؟
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary" id="hasDelTeem">بله</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خیر</button>
            </div>
        </div>
    </div>
</div>