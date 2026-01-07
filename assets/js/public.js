jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


// lightbox.option({
//     "resizeDuration": 200,
//     "wrapAround": true,
//     "imageFadeDuration": 300,
//     "positionFromTop": 50,
//     "showImageNumberLabel": true
// });



function startLoading() {
    var overlay = document.getElementById("overlay");

    if (overlay) {
        overlay.style.display = "flex";
        overlay.style.opacity = "0";
        overlay.style.transition = "opacity 0.5s ease-in-out";

        setTimeout(() => {
            overlay.style.opacity = "1";
        }, 10);
    }

    document.body.classList.add("no-scroll");
}

function endLoading() {

    var overlay = document.getElementById("overlay");

    if (overlay) {
        overlay.style.transition = "opacity 0.5s ease-in-out";
        overlay.style.opacity = "0";

        setTimeout(() => {
            overlay.style.display = "none";
        }, 500);
    }

    document.body.classList.remove("no-scroll");

}


document.querySelectorAll('.goto-btn').forEach(item => {
    item.addEventListener('click', function () {
        const dataBlock = this.getAttribute('data-goto');
        const mapSection = document.getElementById(dataBlock);
        mapSection.scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {


    new Swiper(".newsSwiper", {
        spaceBetween: 10,
        grabCursor: true,
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
                // slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
                // slidesPerGroup: 2,
            },
            1280: {
                slidesPerView: 2,
                spaceBetween: 10,
                // slidesPerGroup: 2,
            }
        }
    });
    new Swiper(".gallerySwiper", {
        spaceBetween: 10,
        freeMode: false,
        loopFillGroupWithBlank: false,
        grabCursor: true,
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
                // slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
                // slidesPerGroup: 2,
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 10,
                // slidesPerGroup: 3,
            }
        }
    });

    //    swiperWinner = new Swiper(".gallerySwiper", {
    //     spaceBetween: 10,
    //     freeMode: true,
    //     grabCursor: true,
    //     loop: true,
    //     pagination: true,
    //     paginationClickable: true,
    //     autoplay: {
    //         delay: 3000,
    //         disableOnInteraction: false,
    //     },
    //     breakpoints: {
    //         0: {
    //             slidesPerView: 2,
    //             spaceBetween: 10,
    //             slidesPerGroup: 2,
    //         },
    //         576: {
    //             slidesPerView: 2,
    //             spaceBetween: 10,
    //             slidesPerGroup: 2,
    //         },
    //         768: {
    //             slidesPerView: 3,
    //             spaceBetween: 10,
    //             slidesPerGroup: 3,
    //         },
    //         1280: {
    //             slidesPerView: 4,
    //             spaceBetween: 10,
    //             slidesPerGroup: 4,
    //         },
    //     },
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true,
    //     },
    // });








    new Swiper(".videoSwiper", {
        spaceBetween: 10,
        freeMode: false,
        loopFillGroupWithBlank: false,
        grabCursor: true,
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 5000, // اختیاری
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
            },
            1280: {
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
            }
        }
    });
    new Swiper(".sliderSwiper", {
        spaceBetween: 10,
        freeMode: false,
        loopFillGroupWithBlank: false,
        grabCursor: true,
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 5000, // اختیاری
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
            },
            1280: {
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
            }
        }
    });

});


function national_code(code) {

    if (!code || code.length !== 10) {
        return false;
    }

    if (!/^\d+$/.test(code)) {
        return false;
    }

    const firstChar = code.charAt(0);
    if (code === firstChar.repeat(10)) {
        return false;
    }

    let sum = 0;
    for (let i = 0; i < 9; i++) {
        sum += (10 - i) * parseInt(code.charAt(i), 10);
    }

    const remainder = sum % 11;
    const lastDigit = parseInt(code.charAt(9), 10);


    if (remainder < 2) {
        return remainder === lastDigit;
    } else {
        return (11 - remainder) === lastDigit;
    }
}

function setToastDanger(massage) {
    const toastElement = document.getElementById('taiToast');



    const toastBody = toastElement.querySelector('.toast-body');

    toastBody.innerHTML = "";
    toastBody.innerHTML = massage;

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElement);
    toastBootstrap.show();
}






function setToastDanger(message, type = 'danger') {
    const toastElement = document.getElementById('taiToast');
    const toastBody = toastElement.querySelector('.toast-body');

    const typeClasses = {
        'success': 'text-bg-success',
        'danger': 'text-bg-danger',
        'warning': 'text-bg-warning',
        'info': 'text-bg-info',
        'primary': 'text-bg-primary'
    };

    Object.values(typeClasses).forEach(cls => {
        toastElement.classList.remove(cls);
    });

    const bgClass = typeClasses[type] || typeClasses['danger'];
    toastElement.classList.add(bgClass);

    toastBody.innerHTML = message;

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElement);
    toastBootstrap.show();
}










jQuery(document).ready(function ($) {
    // $("#download_app").modal("show");

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    $(document).on("input", ".only-fa", function () {
    $(this).val($(this).val().replace(/[^\u0600-\u06FF\s]/g, ""));
});

    let alertSuccess = "alert-success";
    let alertDanger = "alert-danger";

    function alertContact(massage, is_true = true) {


        let alertType = (is_true) ? alertSuccess : alertDanger


        $($alertDiv).html(massage);
        $($alertDiv).addClass(alertType);
        $($alertDiv).removeClass("d-none");

    }




     $('a.post-title').hover(
        function() {
            $(this).removeClass('text-2-lines');
        },
        function() {
            $(this).addClass('text-2-lines');
        }
    );


    $("form#contact_us_form").submit(function (e) {
        e.preventDefault();


        $formDiv = "form#contact_us_form";
        $alertDiv = $formDiv + " #alert";

        let is_true = true;
        let massage = "";


        $($alertDiv).removeClass(alertSuccess);
        $($alertDiv).removeClass(alertDanger);
        $($alertDiv).html("");
        $($alertDiv).addClass("d-none");

        const firstName = $($formDiv + " input[name=first_name]").val();

        if (!firstName && is_true) {
            is_true = false
            massage = "نام خود را وارد کنید";
        }

        const lastName = $($formDiv + " input[name=last_name]").val();


        if (!lastName && is_true) {
            is_true = false
            massage = "نام خانوادگی خود را وارد کنید";
        }

        const mobile = $($formDiv + " input[name=mobile]").val();

        if (!mobile && is_true) {
            is_true = false
            massage = "تلفن تماس خود را وارد کنید";
        }


        const captcha = $($formDiv + " input[name=captcha]").val();

        if (!captcha && is_true) {
            is_true = false
            massage = "کد امنیتی را وارد کنید";
        }


        const description = $($formDiv + " textarea[name=description]").val();

        if (!description && is_true) {
            is_true = false
            massage = "متن خود را وارد کنید";
        }




        if (massage == "" && is_true) {

            startLoading();

            const data = {
                action: 'tai_contact',
                captchaData: $($formDiv + " input#captchaData").val(),
                captcha: captcha,
                firstName: firstName,
                lastName: lastName,
                mobile: mobile,
                description: description,
            }
            $.ajax({
                url: tai_js.ajaxurl,
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {

                    $($formDiv + " input[name=first_name]").val("");
                    $($formDiv + " input[name=last_name]").val("");
                    $($formDiv + " input[name=mobile]").val("");
                    $($formDiv + " input[name=captcha]").val("");
                    $($formDiv + " textarea[name=description]").val("");

                    alertContact(result.data, result.success);
                    endLoading();

                },
                error: function () {

                    massage = "ارسال پیام به خطا خورده است دوباره تلاش  کنید"

                    alertContact(massage, false)

                    console.error("به خطا خورده");

                    endLoading();


                }
            });


        } else {


            alertContact(massage, is_true)

        }

    });


    $("button#saveDashboard").click(function (e) {
        e.preventDefault();

        $formDiv = "section#dashboardForm";

        const groupName = $($formDiv + " input#groupName").val();

        if (!groupName) {
            setToastDanger("نام گروه را وارد کنید");
            return;

        }

        const fullName = $($formDiv + " input#fullName").val();

        if (!fullName) {
            setToastDanger("نام و نام خانوادگی مسئول گروه را وارد کنید");
            return;

        }


        const parent = $($formDiv + " input#parent").val();

        // if (!parent) {
        //     setToastDanger("نام پدرِ مسئول گروه را وارد کنید");
        //     return;

        // }

        const nationalCode = $($formDiv + " input#nationalCode").val();

        if (!nationalCode) {
            setToastDanger("کد ملی مسئول گروه را وارد کنید");
            return;

        }

        if (!national_code(nationalCode)) {
            setToastDanger("کد ملی مسئول گروه را به درستی وارد کنید");
            return;

        }

        const birthday = $($formDiv + " input#birthday").val();

        if (!birthday) {
            setToastDanger("تاریخ تولد مسئول گروه را وارد کنید");
            return;

        }


        const edu = $($formDiv + " input#edu").val();

        // if (!edu && is_true) {
        //     is_true = false;
        //     setToastDanger("مدرک تحصیلی مسئول گروه را وارد کنید");
        // }

        const address = $($formDiv + " textarea#address").val();

        // if (!address && is_true) {
        //     is_true = false;
        //     setToastDanger("محل سکونت مسئول گروه را وارد کنید");
        // }


        const province = $($formDiv + " select#provinces").val();

        if (!Number(province)) {
            setToastDanger("استان مسئول گروه را وارد کنید");
            return;
        }

        const city = $($formDiv + " select#cites").val();
        if (!Number(city)) {
            setToastDanger("شهر مسئول گروه را وارد کنید");
            return;
        }

        const area = $($formDiv + " select#areas").val();
        if (!Number(area) && Number(city) == 331) {
            setToastDanger("منطقه مسئول گروه را وارد کنید");
            return;
        }


        startLoading();

        const data = {
            action: 'tai_dashboard',
            wpnonce: $($formDiv + " input#_wpnonce").val(),
            groupName: groupName,
            fullName: fullName,
            parent: parent,
            nationalCode: nationalCode,
            birthday: birthday,
            edu: edu,
            address: address,
            province: province,
            city: city,
            area: area,
        }

        $.ajax({
            url: tai_js.ajaxurl,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (result) {
                console.log(result);

                if (result.success) {
                    window.location.href = result.data;
                } else {
                    setToastDanger(result.data);
                    endLoading();
                }

                endLoading();

            },
            error: function (e) {
                console.log(e);

                setToastDanger("ثبت اطلاعات شما به خطا خورده است دوباره تلاش  کنید");

                console.error("به خطا خورده");

                endLoading();


            }
        });

    });


    $("button#btnAddTeem").click(function (e) {
        e.preventDefault();



        $formDiv = "section#addTeemForm";

        let is_true = true;


        const fullName = $($formDiv + " input#fullName").val();

        if (fullName == "") {
            setToastDanger("نام خانوادگی را وارد کنید");
            return;
        }

        const parent = $($formDiv + " input#parent").val();
        // if (parent == "") {
        //     setToastDanger("نام پدرِ را وارد کنید");
        //     return;
        // }

        const nationalCode = $($formDiv + " input#nationalCode").val();

        if (nationalCode == "") {
            setToastDanger("کد ملی را وارد کنید");
            return;
        }

        if (!national_code(nationalCode)) {
            setToastDanger("کد ملی را به درستی وارد کنید");
            return;
        }

        const birthday = $($formDiv + " input#birthday").val();

        if (!birthday && is_true) {
            setToastDanger("تاریخ تولد را وارد کنید");
            return;
        }


        const edu = $($formDiv + " input#edu").val();

        // if (edu=="") {
        //     setToastDanger("مدرک تحصیلی مسئول گروه را وارد کنید");
        // return;
        // }


        startLoading();

        const data = {
            action: 'tai_addTeem',
            wpnonce: $($formDiv + " input#_wpnonce").val(),
            fullName: fullName,
            parent: parent,
            nationalCode: nationalCode,
            birthday: birthday,
            edu: edu,
            username: $($formDiv + " input#username").val(),
        }

        $.ajax({
            url: tai_js.ajaxurl,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (result) {

                if (result.success) {

                    window.location.href = result.data;


                } else {
                    setToastDanger(result.data);
                    endLoading();

                }

            },
            error: function () {
                setToastDanger("ثبت اطلاعات شما به خطا خورده است دوباره تلاش  کنید");

                console.error("به خطا خورده");

                endLoading();


            }
        });




    });

    $("button#delTeem").click(function (e) {
        e.preventDefault();

        let userneme = $(this).attr("data-username");

        $("#modalDelTeem #hasDelTeem").attr("href", "/panel/?delTeem=" + userneme);

        $("#modalDelTeem").modal("show");


    });

    $("button#deArt").click(function (e) {
        e.preventDefault();

        let id = $(this).attr("data-tracking-code");

        $("#modalDelArt #hasDelTeem").attr("href", "/panel/?delArt=" + id);

        $("#modalDelArt").modal("show");


    });


    $('#provinces').on('change', function () {


        let province_id = $(this).val()

        if (Number(province_id) > 0) {

            startLoading();

            const data = {
                action: 'tai_cities',
                province_id: Number(province_id),
            }

            $.ajax({
                url: tai_js.ajaxurl,
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (result) {

                    $("#cites").html("");


                    let optionCites = `<option value="0"> انتخاب شهر</option>`;
                    if (result.success) {
                        let cites = result.data;
                        cites.forEach(function (e) {
                            optionCites += `<option value="${e.id}">${e.name}</option>`;
                        });
                        $('#cites').append(optionCites);
                    } else {
                        setToastDanger("دریافت شهر به خطا خورده دوباره تلاش کنید")
                    }
                    endLoading();
                },
                error: function () {

                    massage = "ارسال پیام به خطا خورده است دوباره تلاش  کنید"

                    alertContact(massage, false)

                    console.error("به خطا خورده");

                    endLoading();


                }
            });



        }
    });

    $('#cites').on('change', function () {

        $areasDiv = "#areasDiv";

        let city_id = $(this).val()

        $($areasDiv).addClass("d-none");
        $($areasDiv).removeClass("d-flex");


        if (Number(city_id) == 331) {
            $($areasDiv).addClass("d-flex");
            $($areasDiv).removeClass("d-none");
        }
    });

});
