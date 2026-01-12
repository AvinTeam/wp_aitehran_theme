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

                <div class="w-100 d-flex flex-row justify-content-between align-items-center mb-32">

                    <a href="<?php echo home_url( "/panel/logout" ) ?>"
                        class="btn btn-danger rounded-32 px-24 py-2 f-24 fw-bold">
                        خروج
                    </a>

                    <a href="<?php echo home_url( "/panel/addTeem" ) ?>" class="btn btn-warning rounded-32 px-24 py-2 f-24 fw-bold
                        <?php echo $btn_continue ?> ">
                        مرحله بعد
                    </a>

                </div>



                <section id="dashboardForm" class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

                    <?php wp_nonce_field( config( 'app.key' ) . '_dashboardForm_' . get_current_user_id() ); ?>

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center w-100 flex-nowrap gap-2 ">
                        <div class="">
                            <label for="groupName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام گروه<span
                                    class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupName" value="<?php echo $groupName ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 only-fa">
                        </div>
                    </div>
                    
                    <div class="userProfile"></div>

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="fullName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                و نام خانوادگی<span class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="fullName" value="<?php echo $fullName ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 only-fa">
                        </div>
                    </div>

                    <div
                        class="d-flex  flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="parent" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                پدر :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="parent" value="<?php echo $parent ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 only-fa">
                        </div>
                    </div>

                    <div
                        class="d-flex  flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="nationalCode" class="col-form-label text-nowrap p-2 f-24 fw-bold">کد ملی
                                <span class="text-danger">*</span> :</label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="nationalCode" value="<?php echo $nationalCode ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr onlyNumbersInput"
                                maxlength="10" inputmode="numeric" pattern="\d*">
                        </div>
                    </div>

                    <div
                        class=" d-flex  flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="birthday" class="col-form-label text-nowrap p-2 f-24 fw-bold">تاریخ تولد مسئول
                                گروه<span class="text-danger">*</span> :</label>
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

                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="provinces" class="col-form-label text-nowrap p-2 f-24 fw-bold">استان مسئول
                                گروه<span class="text-danger">*</span> : </label>
                        </div>
                        <div class="w-100">
                            <select class="form-select form-select w-100 border border-1 border-black rounded-32"
                                id="provinces" name="provinces">
                                <option value="0"> انتخاب استان</option>
                                <?php

                                foreach ( $provinces ?? array() as $province ): ?>
                                <option value="<?php echo $province[ 'id' ] ?>"
                                    <?php echo selected( $province[ 'id' ], $user_province ) ?>>
                                    <?php echo $province[ 'name' ] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>


                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="cites" class="col-form-label text-nowrap p-2 f-24 fw-bold">شهر<span
                                    class="text-danger">*</span> : </label>
                        </div>
                        <div class="w-100">
                            <select class="form-select form-select w-100 border border-1 border-black rounded-32"
                                id="cites" name="cites">
                                <option value="0"> انتخاب شهر</option>
                                <?php

                                foreach ( $cities ?? array() as $city ): ?>
                                <option value="<?php echo $city[ 'id' ] ?>"
                                    <?php echo selected( $city[ 'id' ], $user_city ) ?>>
                                    <?php echo $city[ 'name' ] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div id="areasDiv"
                        class="<?php echo 331 == $user_city ? "d-flex" : "d-none" ?>  flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center  w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="areas" class="col-form-label text-nowrap p-2 f-24 fw-bold">منطقه<span
                                    class="text-danger">*</span> : </label>
                        </div>
                        <div class="w-100">
                            <select class="form-select form-select w-100 border border-1 border-black rounded-32"
                                id="areas" name="areas">
                                <option value="0"> انتخاب منطقه</option>
                                <?php

                                for ( $i = 1; $i < 23; ++$i ): ?>
                                <option value="<?php echo $i ?>" <?php echo selected( $i, $user_area ) ?>>
                                    <?php echo sprintf( "منطقه %d", $i ) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-content-between align-items-start w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="address" class="col-form-label text-nowrap p-2 f-24 fw-bold">محل
                                سکونت : </label>
                        </div>
                        <div class="w-100">

                            <textarea rows="5" id="address"
                                class="form-control w-100 border border-1 border-black rounded-32 p-3"><?php echo $address ?></textarea>
                        </div>
                    </div>


                    <div class="d-flex flex-row align-items-center justify-content-center gap-24 ">
                        <button type="button" id="saveDashboard"
                            class="btn btn-warning rounded-32 w-100 p-2 f-24 fw-bold mt ">
                            ثبت تغییرات
                        </button>
                    </div>





                </section>

                <!-- <div class="w-100 d-flex flex-row justify-content-between align-items-center mt-32">

                    <a href="<?php echo home_url( "/panel/addTeem" ) ?> ?>" id="nextLevel"
                        class="btn btn-warning rounded-32 w-75 p-2 f-24 fw-bold mt ">
                        مرحله بعد
                    </a>
                </div> -->



            </div>
        </div>
    </div>
</section>