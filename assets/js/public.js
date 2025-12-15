// jalaliDatepicker.startWatch({
//     minDate: "attr",
//     maxDate: "attr"
// });


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
                slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
            },
            1280: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
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
                slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 10,
                slidesPerGroup: 3,
            }
        }
    });
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










jQuery(document).ready(function ($) {
    // $("#download_app").modal("show");

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });




    let alertSuccess = "alert-success";
    let alertDanger = "alert-danger";

    function alertContact(massage, is_true = true) {


        let alertType = (is_true) ? alertSuccess : alertDanger


        $($alertDiv).html(massage);
        $($alertDiv).addClass(alertType);
        $($alertDiv).removeClass("d-none");

    }


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







});
