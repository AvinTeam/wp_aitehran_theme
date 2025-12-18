<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column-reverse flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">
                <div
                    class="bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">


                    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
                        آموزش‌های کاربردی
                    </div>

                    <div>
                        <img src="<?php echo get_the_image_url( 'panel1.png' ) ?>" alt=""
                            class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 px-2 ">
                <section id="dashboardForm" class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

                    <?php wp_nonce_field( config( 'app.key' ) . '_dashboardForm_' . get_current_user_id() ); ?>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2 ">
                        <div class="">
                            <label for="groupName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام گروه :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupName" value="<?php echo $groupName ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsible" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                خانوادگی مسئول گروه :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsible" value="<?php echo $groupResponsible ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsibleParent" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                پدرِ مسئول گروه :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsibleParent" value="<?php echo $groupResponsibleParent ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsibleNationalCode"
                                class="col-form-label text-nowrap p-2 f-24 fw-bold">شماره شناسنامه
                                مسئول گروه : </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsibleNationalCode"
                                value="<?php echo $groupResponsibleNationalCode ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr">
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsibleBirthday"
                                class="col-form-label text-nowrap p-2 f-24 fw-bold">تاریخ تولد مسئول
                                گروه : </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsibleBirthday"
                                value="<?php echo $groupResponsibleBirthday ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr">

                            <input id="groupResponsibleBirthday" type="text"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr" data-jdp=""
                                data-jdp-only-date="" data-jdp-min-date="today"
                                value="<?php echo $groupResponsibleBirthday ?>">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsibleEdu" class="col-form-label text-nowrap p-2 f-24 fw-bold">مدرک
                                تحصیلی مسئول گروه :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsibleEdu" value="<?php echo $groupResponsibleEdu ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsibleAddress" class="col-form-label text-nowrap p-2 f-24 fw-bold">محل
                                سکونت مسئول گروه
                                : </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsibleAddress"
                                value="<?php echo $groupResponsibleAddress ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="groupResponsibleAddressPost"
                                class="col-form-label text-nowrap p-2 f-24 fw-bold">آدرس پستی :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupResponsibleAddressPost"
                                value="<?php echo $groupResponsibleAddressPost ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>



                    <button type="button"
                        class="btn btn-secondary rounded-32 w-100 p-2 f-24 fw-bold border border-1 border-black">
                        افزودن عضو جدید (+)
                    </button>


                    <div id="alert" class="alert alert-success d-none" role="alert">
                        پیام شما با موفقت ثبت شد
                    </div>

                </section>

                <div class="w-100 d-flex flex-row justify-content-center align-items-center mt-32">
                    <button type="button" id="nextLevel" class="btn btn-warning rounded-32 w-75 p-2 f-24 fw-bold mt ">
                        مرحله بعد
                    </button>
                </div>



            </div>
        </div>
    </div>
</section>