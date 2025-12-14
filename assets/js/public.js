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

});










jQuery(document).ready(function ($) {
    // $("#download_app").modal("show");

    $('button[type=reset]').click(function (e) {
        e.preventDefault();
        $(this).closest('form').find('input').val('');
        $(this).closest('form').find('select:not([id="media_types"])').val('').trigger('change');
        $(this).closest('form').find('select[id="media_types"]').val('poster').trigger('change');
    });


    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });



    $('.shareLink').click(function (e) {
        e.preventDefault();

        let shareLink = $(this).attr('data-shareLink');
        if (shareLink != "") {
            $('#shareModal #eitaa').attr('href', "https://www.eitaa.com/share/url?url=" + shareLink);
            $('#shareModal #bale').attr('href', "https://ble.ir/share/url?url=" + shareLink);
            $('#shareModal #telegram').attr('href', "tg://msg_url?url=" + shareLink);
            $('#shareModal #linkedin').attr('href', "https://www.linkedin.com/cws/share?url=" + shareLink);
            $('#shareModal #copyLink').attr('data-link', shareLink);
            $('#shareModal #copyLink').attr('data-clipboard-text', shareLink);
            $('#copyLinkTextarea').val(shareLink);
            $("#shareModal").modal("show");

            console.log(shareLink);
        }
    });


    $(document).on("change", "select", function (e) {

        let value = $(this).val();
        console.log(value);
        if (value == "") {

            $(this).removeClass('text-primary');
            $(this).addClass('text-primary-emphasis');

        } else {
            $(this).removeClass('text-primary-emphasis');
            $(this).addClass('text-primary');
        }

    });


    let allItems = $(".mpgallery-item");

    function filterUniqueItems() {
        let seenIds = {};
        let uniqueItems = allItems.filter(function () {
            let itemId = $(this).data("id");
            if (!seenIds[itemId]) {
                seenIds[itemId] = true;
                return true;
            }
            return false;
        });

        allItems.hide();
        uniqueItems.slice(0, 12).show();
    }

    filterUniqueItems();


    $(".mpcategories button").on("click", function () {

        $(".mpcategories button").removeClass("mpactive");
        $(this).addClass("mpactive");

        let filter = $(this).data("filter");

        if (filter === "all") {
            filterUniqueItems();
        } else {
            let categoryItems = $(".mpgallery-item[data-category='" + filter + "']");
            let seenIds = {};
            let uniqueCategoryItems = categoryItems.filter(function () {
                let itemId = $(this).data("id");
                if (!seenIds[itemId]) {
                    seenIds[itemId] = true;
                    return true;
                }
                return false;
            });

            allItems.hide();
            uniqueCategoryItems.slice(0, 12).show();
        }
    });

    function gotoNumStyle1(type, id) {

        let slides = document.querySelectorAll("#mr_aparat_" + id + " .ma_item");

        let mrAparatActiveId = $('#mr_aparat_' + id + ' #mr_aparat_style_1 .active').attr('id').split("mr_aparat_view_");

        let current = mrAparatActiveId[1];

        let prevn = 0;
        let nextn = 0;


        if (type == 'next') {
            current++;

            if (current == slides.length) { current = 0; }
            if (current == 0) { prevn = slides.length - 1 } else { prevn = current - 1; }
            if (current == slides.length - 1) { nextn = 0 } else { nextn = current + 1; }
        }


        if (type == 'prev') {
            current--;

            if (current == -1) { current = slides.length - 1; }
            if (current == 0) { prevn = slides.length - 1 } else { prevn = current - 1; }
            if (current == slides.length - 1) { nextn = 0 } else { nextn = current + 1; }
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
            slides[i].classList.remove("prev");
            slides[i].classList.remove("next");
        }

        slides[current].classList.add("active");
        slides[prevn].classList.add("prev");
        slides[nextn].classList.add("next");

    };

    $('.ma_btm_next').click(function (e) {


        let mrAparatId = $(this).parent().attr('id').split("button-container_");

        gotoNumStyle1('next', mrAparatId[1])

        e.preventDefault();

    });


    $('.ma_btm_prev').click(function (e) {

        let mrAparatId = $(this).parent().attr('id').split("button-container_");

        gotoNumStyle1('prev', mrAparatId[1])

        e.preventDefault();

    });


    $('#tai-ayeh-form').submit(function (e) {
        e.preventDefault();

        let massegeError = "";

        let voteAyeh = $('input[name="vote_ayeh"]:checked').val();
        if (!voteAyeh) {
            massegeError += `<div class="alert alert-danger" role="alert">
                                هیچ آیه ای انتخاب نشده است.
                            </div>`;
        }

        let phone = $('input[name="phone"]').val();

        if (!phone || phone.length != 11) {
            massegeError += `<div class="alert alert-danger" role="alert">
                                شماره موبایل خود را وارد کنید.
                            </div>`;
        }

        let captcha = $('input[name="captcha"]').val();

        if (!captcha) {
            massegeError += `<div class="alert alert-danger" role="alert">
                                سوال امنیتی را وارد کنید.
                            </div>`;
        }

        if (massegeError != "") {
            $('#form-alert-vote-ayeh').html(massegeError);
        } else {
            this.submit();
        }

    });


    $(document).ready(function () {
        if ($('.show-timer-internet').length === 0) {
            return;
        }

        function updateTimerInternet() {
            const now = new Date();
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();
            const currentSecond = now.getSeconds();
            const timeStamp = Number(tai_js.clock.setting.time_stamp);

            const raceStartHour = 9;
            const raceEndHour = 22;

            let nextRaceHour, timeRemaining;

            if (currentHour >= raceStartHour && currentHour < raceEndHour) {
                nextRaceHour = currentHour + 1;

                if (currentMinute < timeStamp) {
                    timeRemaining = "مسابقه در حال انجام است";
                } else {
                    const minutesLeft = 59 - currentMinute;
                    const secondsLeft = 59 - currentSecond;

                    timeRemaining =
                        `${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;
                }
            } else {

                if (currentHour >= raceEndHour) {
                    nextRaceHour = raceStartHour;
                    const hoursLeft = (24 - currentHour) + nextRaceHour;
                    const minutesLeft = 59 - currentMinute;
                    const secondsLeft = 59 - currentSecond;
                    timeRemaining =
                        `${hoursLeft}:${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;
                } else {
                    nextRaceHour = raceStartHour;
                    const hoursLeft = nextRaceHour - currentHour - 1;
                    const minutesLeft = 59 - currentMinute;
                    const secondsLeft = 59 - currentSecond;
                    timeRemaining =
                        `${hoursLeft}:${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;
                }
            }

            $('.show-timer-internet').text(timeRemaining);
        }

        updateTimerInternet();

        setInterval(updateTimerInternet, 1000);
    });


    $(document).ready(function () {
        if ($('.show-timer-tv').length === 0) {
            return;
        }


        function updateTimerTV() {
            const now = Math.floor(Date.now() / 1000);
            const clocks = tai_js.clock.clocks;
            const competitionDuration = Number(tai_js.clock.setting.time_stamp) * 60;

            // تبدیل شیء clocks به آرایه و مرتب‌سازی بر اساس تایم‌استمپ
            const clockArray = Object.values(clocks).sort((a, b) => a.id - b.id);

            let currentRace = null;
            let nextRace = null;

            // پیدا کردن مسابقه فعلی و بعدی
            for (let i = 0; i < clockArray.length; i++) {
                const race = clockArray[i];

                // اگر مسابقه در حال اجرا باشد (در بازه 15 دقیقه اول)
                if (now >= race.id && now < race.id + competitionDuration) {
                    currentRace = race;
                    break;
                }

                // اگر مسابقه هنوز شروع نشده باشد
                if (race.id > now) {
                    nextRace = race;
                    break;
                }
            }

            // اگر مسابقه‌ای در حال اجرا پیدا نشد، اولین مسابقه آینده را پیدا کن
            if (!currentRace && !nextRace) {
                for (let i = 0; i < clockArray.length; i++) {
                    if (clockArray[i].id > now) {
                        nextRace = clockArray[i];
                        break;
                    }
                }
            }

            let displayText = "";
            if (currentRace) {
                displayText = "مسابقه در حال انجام است";
            } else if (nextRace) {
                // اگر مسابقه بعدی وجود دارد
                const timeUntilNextRace = nextRace.id - now;

                if (timeUntilNextRace > 0) {
                    const hours = Math.floor(timeUntilNextRace / 3600);
                    const minutes = Math.floor((timeUntilNextRace % 3600) / 60);
                    const seconds = timeUntilNextRace % 60;
                    displayText = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                } else {
                    displayText = "مسابقه به زودی شروع می‌شود";
                }
                $('.show-timer-tv').removeClass('d-none');
            } else {

                $('.show-timer-tv').addClass('d-none');

                displayText = "مسابقه‌ای برنامه‌ریزی نشده است";
            }

            $('.show-timer-tv').text(displayText);
        }

        updateTimerTV();

        setInterval(updateTimerTV, 1000);
    });




});
