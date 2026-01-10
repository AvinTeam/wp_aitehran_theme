<?php

    use TAI\App\Core\Captcha;

    $captcha = new Captcha();

    $array = $captcha->create_image();

?>

<section class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">

    <form id="loginForm">
        <div id="mobileForm">

            <input type="hidden" id="captchaData" value="<?php echo $array[ 'key' ] ?>">

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
                        <img src="<?php echo $array[ 'url' ] ?>" class="h-45 object-fit-cover">
                    </div>
                    <input type="text" id="captcha" value="<?php echo $array[ 'word' ] ?? "" ?>"
                        maxlength="<?php echo TAI_CAPTCHA_LEN ?>"
                        class="w-100 rounded-32 overflow-hidden border-1 border border-black f-24 fw-bold text-center p-2">
                </div>
                <button id="send-code" class="btn btn-warning fw-bold f-20 mt-5 mb-3 rounded-40" type="submit"
                    disabled>ارسال کد امنیتی به شماره همراه</button>

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

                <button type="submit" id="verifyCode" class="btn btn-warning fw-bold f-20 mt-5 mb-3 rounded-40"
                    disabled>تایید کد</button>
                <button type="button" id="editNumber" class="btn btn-secondary rounded-40">ویرایش
                    شماره</button>

            </div>

        </div>
    </form>


</section>