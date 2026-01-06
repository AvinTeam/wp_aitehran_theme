<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column-reverse flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
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
                <div class="w-100 d-flex flex-row justify-content-between align-items-center mb-32">

                    <a href="<?php echo home_url( "/panel" ) ?>"
                        class="btn btn-dark rounded-32 px-24 py-2 f-24 fw-bold">
                        بازگشت
                    </a>
                </div>
                <section id="addTeemForm" class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

                    <?php wp_nonce_field( config( 'app.key' ) . '_addTeemForm_' . get_current_user_id() ); ?>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="fullName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                خانوادگی :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="fullName" value="<?php echo $fullName ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="parent" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                پدرِ :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="parent" value="<?php echo $parent ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="nationalCode"
                                class="col-form-label text-nowrap p-2 f-24 fw-bold">کد ملی : </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="nationalCode"
                                value="<?php echo $nationalCode ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr onlyNumbersInput" maxlength="10"  inputmode="numeric" pattern="\d*">

                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="birthday"
                                class="col-form-label text-nowrap p-2 f-24 fw-bold">تاریخ تولد : </label>
                        </div>
                        <div class="w-100">

                            <input id="birthday" type="text"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr" data-jdp=""
                                data-jdp-only-date="" data-jdp-max-date="today"
                                value="<?php echo $birthday ?>">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="edu" class="col-form-label text-nowrap p-2 f-24 fw-bold">مدرک
                                تحصیلی :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="edu" value="<?php echo $edu ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>
                <input type="hidden"  id="username" value="<?php echo( isset( $_GET[ 'teem' ] ) && ! empty( $_GET[ 'teem' ] ) ) ? $_GET[ 'teem' ] : 0 ?>" >

                </section>

                <div class="w-100 d-flex flex-row justify-content-center align-items-center mt-32">
                    <button type="button" id="btnAddTeem" class="btn btn-warning rounded-32 w-75 p-2 f-24 fw-bold mt ">
                        ثبت
                    </button>
                </div>



            </div>
        </div>
    </div>
</section>