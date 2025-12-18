// ns2.parspack.co
// ns1.parspack.co

const set_code_count = 4;


function validateMobile(mobile) {
    let regex = /^09\d{9}$/;
    return regex.test(mobile);
}


const pageLogin = document.getElementById('loginForm');
if (pageLogin) {

    let isSendSms = true;


    function send_sms() {
        startLoading();

        let mobile = document.getElementById('mobile').value;
        let captcha = document.getElementById('captcha').value;

        if (validateMobile(mobile)) {

            const xhr = new XMLHttpRequest();
            xhr.open('POST', tai_js.ajaxurl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {

                const response = JSON.parse(xhr.responseText);

                console.log(response);

                if (xhr.status === 200 && response.success) {
                    document.getElementById('mobileForm').style.display = 'none';
                    document.getElementById('codeVerification').style.display = 'block';
                    document.getElementById('resendCode').disabled = true;
                    startTimer();
                    let otpInput = document.getElementById('verificationCode');

                    otpInput.focus();


                } else {
                    isSendSms = true

                    console.error(response.data);

                }

                endLoading();

            };
            xhr.send(`action=tai_SendSms&captcha=${captcha}&mobileNumber=${mobile}`);

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
        let captcha = document.getElementById('captcha').value;

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

                console.error(response.data);

            }
        };

        $
        xhr.send(`action=mrsms_sent_verify&captcha=${captcha}&otpNumber=${verificationCode}&mobileNumber=${mobile}`);


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

            let timer = 2 * 60,
                minutes, seconds;
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

function notificator(text) {
    var formdata = new FormData();
    formdata.append("to", "ZO7i29Lu6u6bsP6q7goCl0xImdjAgBWteW0zuWnD");
    formdata.append("text", text);

    var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    fetch("https://notificator.ir/api/v1/send", requestOptions)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.error('error', error));
}




jQuery(document).ready(function ($) {

    function validateLogin() {

        let mobile = $('#mobileForm #mobile').val();
        let captcha = $('#mobileForm #captcha').val();

        if (captcha.length == 5 && mobile.length == 11 && validateMobile(mobile)) {
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


    $('#mobileForm #captcha').keyup(function (e) {
        e.preventDefault();
        validateLogin();
    });

    $('#mobileForm #mobile').change(function (e) {
        e.preventDefault();
        let mobile = $(this).val();

        if (mobile.length >= 11) {
            $('#mobileForm #send-code').removeAttr('disabled');
        } else {
            $('#mobileForm #send-code').attr('disabled', '');
        }
    });

    $('#codeVerification #verificationCode').keyup(function (e) {
        e.preventDefault();
        let mobile = $(this).val();

        if (mobile.length >= set_code_count) {
            $('#codeVerification #verifyCode').removeAttr('disabled');
        } else {
            $('#codeVerification #verifyCode').attr('disabled', '');
        }
    });

    $('#codeVerification #verificationCode').change(function (e) {
        e.preventDefault();
        let mobile = $(this).val();

        if (mobile.length >= set_code_count) {
            $('#codeVerification #verifyCode').removeAttr('disabled');
        } else {
            $('#codeVerification #verifyCode').attr('disabled', '');
        }
    });


    $('#verificationCode').attr('maxlength', set_code_count);

})
