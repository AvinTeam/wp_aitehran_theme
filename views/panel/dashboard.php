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
                <?php getAlert(); ?>

                <section id="dashboardForm" class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

                    <?php wp_nonce_field( config( 'app.key' ) . '_dashboardForm_' . get_current_user_id() ); ?>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2 ">
                        <div class="">
                            <label for="groupName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام گروه<span
                                    class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="groupName" value="<?php echo $groupName ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="fullName" class="col-form-label text-nowrap p-2 f-24 fw-bold">نام
                                و نام خانوادگی مسئول گروه<span class="text-danger">*</span> :
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
                                پدرِ مسئول گروه<span class="text-danger">*</span> :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="parent" value="<?php echo $parent ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="nationalCode" class="col-form-label text-nowrap p-2 f-24 fw-bold">کد ملی
                                مسئول گروه<span class="text-danger">*</span> :</label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="nationalCode" value="<?php echo $nationalCode ?>"
                                class="form-control w-100 border border-1 border-black rounded-32 d-ltr onlyNumbersInput"
                                maxlength="10" inputmode="numeric" pattern="\d*">
                        </div>
                    </div>
                    <div class=" d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
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

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="edu" class="col-form-label text-nowrap p-2 f-24 fw-bold">مدرک
                                تحصیلی مسئول گروه :
                            </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="edu" value="<?php echo $edu ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="provinces" class="col-form-label text-nowrap p-2 f-24 fw-bold">استان مسئول گروه<span class="text-danger">*</span> : </label>
                        </div>
                        <div class="w-100">
                            <select class="form-select form-select w-100 border border-1 border-black rounded-32" id="provinces" name="provinces">
                                <option value="0"> انتخاب استان</option>
                                <?php foreach ( $provinces ?? array(  ) as $province ): ?>
                                <option value="<?php echo $province[ 'id' ] ?>"
                                    <?php echo selected( $province[ 'id' ], $user_province ) ?>>
                                    <?php echo $province[ 'name' ] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                    
                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="cites" class="col-form-label text-nowrap p-2 f-24 fw-bold">شهر مسئول گروه<span class="text-danger">*</span> : </label>
                        </div>
                        <div class="w-100">
                            <select class="form-select form-select w-100 border border-1 border-black rounded-32" id="cites" name="cites">
                                <option value="0"> انتخاب شهر</option>
                                <?php foreach ( $cities ?? array(  ) as $city ): ?>
                                <option value="<?php echo $city[ 'id' ] ?>"
                                    <?php echo selected( $city[ 'id' ], $user_city ) ?>>
                                    <?php echo $city[ 'name' ] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <!-- tehrn 331 -->
                    <div id="areasDiv" class="d-none flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="areas" class="col-form-label text-nowrap p-2 f-24 fw-bold">منطقه مسئول گروه<span class="text-danger">*</span> : </label>
                        </div>
                        <div class="w-100">
                            <select class="form-select form-select w-100 border border-1 border-black rounded-32" id="areas" name="areas">
                                <option value="0"> انتخاب شهر</option>
                                <?php foreach ( $cities ?? array(  ) as $city ): ?>
                                <option value="<?php echo $city[ 'id' ] ?>"
                                    <?php echo selected( $city[ 'id' ], $user_city ) ?>>
                                    <?php echo $city[ 'name' ] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>



                    <div class="d-flex flex-row justify-content-between align-items-center w-100 flex-nowrap gap-2">
                        <div class="">
                            <label for="address" class="col-form-label text-nowrap p-2 f-24 fw-bold">محل
                                سکونت مسئول گروه : </label>
                        </div>
                        <div class="w-100">
                            <input type="text" id="address" value="<?php echo $address ?>"
                                class="form-control w-100 border border-1 border-black rounded-32">
                        </div>
                    </div>

                    <?php
                        $m = 1;

                    if ( $teems ): ?>


                    <h2>لیست اعضا</h2>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام خانوادگی</th>
                                <th scope="col">کد ملی</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            foreach ( $teems as $teem ): ?>
                            <tr>
                                <th scope="row"><?php echo $m ?></th>
                                <td><?php echo $teem[ 'name' ] ?></td>
                                <td><?php echo $teem[ 'nationalCode' ] ?></td>
                                <td>
                                    <a href="<?php echo home_url( '/panel/addTeem/?teem=' . $teem[ 'username' ] ) ?>"
                                        class="btn btn-info">ویرایش</a>
                                    <button type="button" id="delTeem" data-username="<?php echo $teem[ 'username' ] ?>"
                                        class="btn btn-danger">حذف</button>
                                </td>
                            </tr>

                            <?php ++$m;endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>

                    <?php

                    if ( $m <= 4 ): ?>
                    <a href="<?php echo home_url( "/panel/addTeem" ) ?>"
                        class="btn btn-secondary rounded-32 w-100 p-2 f-24 fw-bold border border-1 border-black">
                        افزودن عضو جدید (+)
                    </a>
                    <?php endif; ?>

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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خیر</button>
                <a href="" class="btn btn-primary" id="hasDelTeem">بله</a>
            </div>
        </div>
    </div>
</div>