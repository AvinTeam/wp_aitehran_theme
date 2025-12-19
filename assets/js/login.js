// ns2.parspack.co
// ns1.parspack.co


function validateMobile(mobile) {
    let regex = /^09\d{9}$/;
    return regex.test(mobile);
}

let timerSms = 0;

const pageLogin = document.getElementById('loginForm');
if (pageLogin) {

    let isSendSms = true;


    function send_sms() {
        startLoading();

        let mobile = document.getElementById('mobile').value;
        let captcha = document.getElementById('captcha').value;
        let captchaData = document.getElementById('captchaData').value;

        if (validateMobile(mobile)) {

            const xhr = new XMLHttpRequest();
            xhr.open('POST', tai_js.ajaxurl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {

                const response = JSON.parse(xhr.responseText);
                if (xhr.status === 200 && response.success) {
                    document.getElementById('mobileForm').style.display = 'none';
                    document.getElementById('codeVerification').style.display = 'block';
                    document.getElementById('resendCode').disabled = true;
                    let otpInput = document.getElementById('verificationCode');

                    otpInput.focus();

                    timerSms = response.data.timer;

                    setToastDanger(response.data.massage, 'success');

                    startTimer();

                } else {
                    setToastDanger(response.data);

                    isSendSms = true


                }

                endLoading();

            };
            xhr.send(`action=tai_SendSms&captcha=${captcha}&mobileNumber=${mobile}&captchaData=${captchaData}`);

        } else {
            isSendSms = true

            console.error('شماره موبایل نامعتبر است');
            endLoading();

        }
    }

    pageLogin.addEventListener('submit', function (event) {
        event.preventDefault();

        if (isSendSms) {
            isSendSms = false;
            send_sms();
        }
    });

    document.getElementById('verifyCode').addEventListener('click', function () {
        startLoading();

        let mobile = document.getElementById('mobile').value;

        let verificationCode = document.getElementById('verificationCode').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', tai_js.ajaxurl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {

            const response = JSON.parse(xhr.responseText);
            endLoading();

            if (xhr.status === 200) {
                if (response.success) {
                    location.reload();
                }
            } else {
                setToastDanger(response.data);
                console.error(response.data);
            }
        };

        xhr.send(`action=tai_verifySms&otpNumber=${verificationCode}&mobileNumber=${mobile}`);


    });

    document.getElementById('editNumber').addEventListener('click', function () {
        document.getElementById('mobileForm').style.display = 'block';
        document.getElementById('codeVerification').style.display = 'none';
        isSendSms = true;
        startTimer(true);

    });

    document.getElementById('resendCode').addEventListener('click', function () {
        send_sms();
    });

    function startTimer(end = false) {

        if (end) { clearInterval(interval); } else {

            let timer = tai_js.sms_timer * 60;
            let minutes, seconds;

            if (Number(timerSms)) {
                timer = timerSms;
            }

            interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                document.getElementById('timer').textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    document.getElementById('resendCode').disabled = false;
                }
            }, 1000);
        }
    }

    if ('OTPCredential' in window) {
        const verifyCodeButton = document.getElementById('verifyCode');

        const inputVerificationCode = document.getElementById('verificationCode');

        if (inputVerificationCode) {

            const ac = new AbortController();

            navigator.credentials
                .get({
                    otp: {
                        transport: ['sms'],
                    },
                    signal: ac.signal,
                })
                .then((otp) => {

                    if (otp && otp.code) {
                        inputVerificationCode.value = otp.code;

                        verifyCodeButton.click();

                        verifyLogin(otp.code);


                    } else { }

                    ac.abort();
                })
                .catch((err) => {

                    if (ac.signal.aborted === false) {
                        ac.abort();
                    }
                });
        }
    }
}


jQuery(document).ready(function ($) {

    function validateLogin() {

        let mobile = $('#mobileForm #mobile').val();
        let captcha = $('#mobileForm #captcha').val();
        if (
            captcha != "" &&
            captcha.length == tai_js.captcha_len &&
            mobile.length == 11 && validateMobile(mobile)
        ) {
            $('#mobileForm #send-code').removeAttr('disabled');
        } else {
            $('#mobileForm #send-code').attr('disabled', '');
        }


    }

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    $('#mobileForm #mobile').keyup(function (e) {
        e.preventDefault();
        validateLogin();
    });

    $('#mobileForm #mobile').change(function (e) {
        e.preventDefault();
        validateLogin();
    });


    $('#mobileForm #captcha').keyup(function (e) {
        e.preventDefault();
        validateLogin();
    });

    $('#mobileForm #captcha').change(function (e) {
        e.preventDefault();
        validateLogin();
    });

    $('#codeVerification #verificationCode').keyup(function (e) {
        e.preventDefault();
        let mobile = $(this).val();

        if (mobile.length >= tai_js.code_count) {
            $('#codeVerification #verifyCode').removeAttr('disabled');
        } else {
            $('#codeVerification #verifyCode').attr('disabled', '');
        }
    });

    $('#codeVerification #verificationCode').change(function (e) {
        e.preventDefault();
        let mobile = $(this).val();

        if (mobile.length >= tai_js.code_count) {
            $('#codeVerification #verifyCode').removeAttr('disabled');
        } else {
            $('#codeVerification #verifyCode').attr('disabled', '');
        }
    });


    $('#verificationCode').attr('maxlength', tai_js.code_count);

})
