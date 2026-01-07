<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column-reverse flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">
                <div
                    class="bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">


                    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
                       ورود و ثبت نام
                    </div>

                    <div>
                        <img src="<?php echo get_the_image_url( 'panel1.png' ) ?>" alt=""
                            class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 px-2 ">

                <section class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

                    <form id="loginForm">
                        <div id="mobileForm">

                            <input type="hidden" id="captchaData" value="<?php echo $key ?>">

                            <div class="d-flex flex-column row-gap-2">
                                <div class="d-flex flex-column row-gap-2 ">
                                    <label class="f-24 fw-bold" for="mobile">شماره تماس</label>
                                    <input type="text" inputmode="numeric" pattern="\d*"
                                        class="text-center p-2 onlyNumbersInput w-100 rounded-32 overflow-hidden border-1 border border-black f-24 fw-bold"
                                        id="mobile" maxlength="11" aria-describedby="sendsms">
                                </div>

                                <div class="d-flex flex-column row-gap-2 ">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <label class="f-24 fw-bold" for="captcha">کد امنیتی</label>
                                        <img src="<?php echo $url ?>" class="h-45 object-fit-cover">
                                    </div>
                                    <input type="text" id="captcha" value="<?php echo $word ?? "" ?>"
                                        maxlength="<?php echo TAI_CAPTCHA_LEN ?>"
                                        class="w-100 rounded-32 overflow-hidden border-1 border border-black f-24 fw-bold text-center p-2">
                                </div>
                                <button id="send-code" class="btn btn-warning fw-bold f-20 mt-5 mb-3 rounded-40"
                                    type="submit" disabled>ارسال کد امنیتی به شماره همراه</button>

                            </div>

                        </div>
                        <div id="codeVerification" style="display: none;">
                            <div class="d-flex flex-column row-gap-2">
                                <div class="d-flex flex-column row-gap-2 ">
                                    <label class="f-24 fw-bold" for="mobile">کد تایید</label>
                                    <input autocomplete="one-time-code" type="text" inputmode="numeric" pattern="\d*"
                                        class="text-center p-2 onlyNumbersInput w-100 rounded-32 overflow-hidden border-1 border border-black f-24 fw-bold"
                                        id="verificationCode" aria-describedby="verify">
                                </div>
                                <div class="d-flex flex-row justify-content-around align-items-center">
                                    <div id="timer">00:00</div>
                                    <button type="button" id="resendCode" class="btn btn-line rounded-40" disabled>ارسال
                                        مجدد کد</button>
                                </div>

                                <button type="submit" id="verifyCode"
                                    class="btn btn-warning fw-bold f-20 mt-5 mb-3 rounded-40" disabled>تایید کد</button>
                                <button type="button" id="editNumber" class="btn btn-secondary rounded-40">ویرایش
                                    شماره</button>

                            </div>

                        </div>
                    </form>


                </section>



            </div>
        </div>
    </div>
</section>
























<!-- <form id="loginForm" class="bg-white">
            <input type="hidden" id="created_user" name="created_user" value="true">

            <div id="mobileForm">
                <h3 class="text-center mt-2">ورود / ثبت نام</h3>
                <p class="text-center">جهت ورود</p>

                <div class="form-group text-start">
                    <label for="mobile">شماره موبایل</label>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="sendsms"><i class="bi bi-phone"></i></span>
                        <input type="text" inputmode="numeric" pattern="\d*" class="form-control  onlyNumbersInput" id="mobile" maxlength="11" placeholder="شماره موبایل خود را وارد کنید" aria-describedby="sendsms">

                    </div>
                </div>
                <div class="form-group d-grid mt-2 ">
                    <button type="submit" class="btn btn-primary bg-gradiant  btn-block">ورود</button>

                </div>
            </div>
            <div id="codeVerification" class="text-start" style="display: none;">
                <h4 class="text-center">کد تایید</h4>
                <div class="form-group d-grid mt-2">
                    <label for="verificationCode">کد تایید</label>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="verify"><i class="bi bi-person-fill"></i></span>
                        <input autocomplete="one-time-code" type="text" inputmode="numeric" pattern="\d*" class="form-control onlyNumbersInput" id="verificationCode" placeholder="کد تایید را وارد کنید" aria-describedby="verify" maxlength="4">
                    </div>
                </div>
                <div class="d-grid mt-2 gap-2">
                    <div class="timer text-center" id="timer">00:00</div>

                    <button type="submit" class="btn btn-primary bg-gradiant btn-block" id="verifyCode">تایید
                        کد</button>
                    <button type="button" class="btn btn-secondary btn-block" id="resendCode" disabled="">ارسال مجدد
                        کد</button>
                    <button type="button" class="btn btn-link btn-block" id="editNumber">ویرایش شماره</button>
                </div>
            </div>
            <div id="login-alert" class="alert alert-danger mt-2 d-none" role="alert"></div>

        </form>
        <div style="height: 100px;"></div> -->

</div>