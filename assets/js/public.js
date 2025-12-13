jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


lightbox.option({
    "resizeDuration": 200,
    "wrapAround": true,
    "imageFadeDuration": 300,
    "positionFromTop": 50,
    "showImageNumberLabel": true
});



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

const counterNumber = document.querySelectorAll('.counter-number');
if (counterNumber) {
    function startCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const step = Math.ceil(target / (duration / 16));
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = current.toLocaleString();
        }, 16);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });


    counterNumber.forEach(counter => {
        observer.observe(counter);
    });

}

const textAyehs = document.querySelectorAll('.text-ayeh');
if (textAyehs) {

    let western = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    let persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    let arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    function convertToArabic(text) {
        let result = text;

        for (let i = 0; i < 10; i++) {
            result = result.replace(new RegExp(persian[i], 'g'), arabic[i]);
        }

        for (let i = 0; i < 10; i++) {
            result = result.replace(new RegExp(western[i], 'g'), arabic[i]);
        }

        return result;
    }


    textAyehs.forEach(textAyeh => {
        textAyeh.textContent = convertToArabic(textAyeh.textContent);
    });
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

    new Swiper(".supportersSwiper", {
        spaceBetween: 10,
        freeMode: false,
        grabCursor: true,
        loopFillGroupWithBlank: false,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 3,
                spaceBetween: 10,
                slidesPerGroup: 3,
            },
            576: {
                slidesPerView: 5,
                spaceBetween: 10,
                slidesPerGroup: 5,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 10,
                slidesPerGroup: 5,
            },
            1280: {
                slidesPerView: 10,
                spaceBetween: 10,
                slidesPerGroup: 10,
            },
        },
    });



    new Swiper(".posterSwiper", {
        spaceBetween: 10,
        grabCursor: true,
        pagination: true,
        paginationClickable: true,
        breakpoints: {
            0: {
                slidesPerView: 1.5,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1280: {
                slidesPerView: 5,
                spaceBetween: 10,
            }
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });


    new Swiper(".textImageSwiper", {
        spaceBetween: 10,
        grabCursor: true,
        pagination: true,
        paginationClickable: true,
        breakpoints: {
            0: {
                slidesPerView: 1.5,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 10,
            }
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });


    new Swiper(".videoSwiper", {
        spaceBetween: 10,
        grabCursor: true,
        pagination: true,
        paginationClickable: true,
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 10,
            }
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    


    new Swiper(".soundSwiper", {
        spaceBetween: 10,
        grabCursor: true,
        pagination: true,
        paginationClickable: true,
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 10,
            }
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    // new Swiper('.ayeh-swiper', {
    //     slidesPerView: 2.5,
    //     centeredSlides: true,
    //     loop: true,
    //     spaceBetween: 20,
    //     grabCursor: true,
    //     pagination: true,
    //     paginationClickable: true,
    //     autoplay: {
    //         delay: 5000,
    //         disableOnInteraction: false,
    //     },
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    //     effect: 'coverflow',
    //     coverflowEffect: {
    //         rotate: 0,
    //         stretch: 50,
    //         depth: 150,
    //         modifier: 1,
    //         slideShadows: false,
    //     },
    //     breakpoints: {
    //         1000: { slidesPerView: 3.5 },
    //         0: { slidesPerView: 1 } 
    //     },
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true,
    //     },
    // });

});

document.addEventListener("DOMContentLoaded", function () {
    function getMobileOperatingSystem() {
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        if (/android/i.test(userAgent)) {
            return "Android";
        } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "iOS";
        }
        return "Unknown";
    }

    var os = getMobileOperatingSystem();

    if (os === "iOS") {
        document.getElementById("android-tab").classList.remove("active");
        document.getElementById("android").classList.remove("show", "active");

        document.getElementById("ios-tab").classList.add("active");
        document.getElementById("ios").classList.add("show", "active");
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const radioButtons = document.querySelectorAll('.tai-radio');

    radioButtons.forEach(button => {
        button.addEventListener('click', function () {
            radioButtons.forEach(btn => {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-primary');
            });

            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-success');

            const radioInput = this.querySelector('input[type="radio"]');
            if (radioInput) {
                radioInput.checked = true;
            }
        });
    });
});







let swiper;
let currentCategory = "all";

function filterGiftSlides(category = "all") {
    const slides = document.querySelectorAll('.giftSwiper .swiper-slide');

    if (slides.length > 0) {
        slides.forEach(slide => {
            if (category === "all" || slide.getAttribute('data-id') === "campaign_" + category) {
                slide.classList.remove('d-none');
            } else {
                slide.classList.add('d-none');
            }
        });

        if (swiper) {
            setTimeout(() => {
                swiper.update();
                swiper.slideTo(0);
            }, 50);
        }
    }
}

function initGiftSwiper() {
    swiper = new Swiper(".giftSwiper", {
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
        loop: true,
        pagination: true,
        paginationClickable: true,
        // autoplay: {
        //     delay: 3000,
        //     disableOnInteraction: false,
        // },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
                slidesPerGroup: 3,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 10,
                slidesPerGroup: 4,
            },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

}

function setupGiftTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');

    if (tabButtons) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                tabButtons.forEach(btn => btn.classList.remove('btn-primary'));
                tabButtons.forEach(btn => btn.classList.add('btn-outline-primary-subtle'));

                this.classList.add('btn-primary');
                this.classList.remove('btn-outline-primary-subtle');

                currentCategory = this.getAttribute('data-id');

                filterGiftSlides(currentCategory);
            });
        });
    }
}


let swiperWinner;
let currentWinner = "all";

function filterWinnerSlides(category = "all") {
    const slides = document.querySelectorAll('.winnerSwiper .swiper-slide');
    if (slides.length > 0) {
        slides.forEach(slide => {
            if (category === "all" || slide.getAttribute('data-id') === "campaign_" + category) {
                slide.classList.remove('d-none');
            } else {
                slide.classList.add('d-none');
            }
        });

        if (swiperWinner) {
            setTimeout(() => {
                swiperWinner.update();
                swiperWinner.slideTo(0);
            }, 50);
        }
    }
}

function initWinnerSwiper() {

    swiperWinner = new Swiper(".winnerSwiper", {
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
        loop: true,
        pagination: true,
        paginationClickable: true,
        // autoplay: {
        //     delay: 3000,
        //     disableOnInteraction: false,
        // },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 10,
                slidesPerGroup: 2,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
                slidesPerGroup: 3,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 10,
                slidesPerGroup: 4,
            },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

}

function setupWinnerTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn-winner');
    if (tabButtons) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                tabButtons.forEach(btn => btn.classList.remove('btn-primary'));
                tabButtons.forEach(btn => btn.classList.add('btn-outline-primary-subtle'));

                this.classList.add('btn-primary');
                this.classList.remove('btn-outline-primary-subtle');

                currentWinner = this.getAttribute('data-id');

                filterWinnerSlides(currentWinner);
            });
        });
    }
}

let swiperMedia;
let currentMedia = "poster";

function filterMediaSlides(type = "poster") {
    const mediaItem = document.querySelectorAll('.mediaSection .mediaItem');


    mediaItem.forEach(item => {
        if (item.getAttribute('id') === type) {
            item.classList.remove('d-none');
        } else {
            item.classList.add('d-none');
        }
    });

}

function setupMediaTabs() {
    const tabButtons = document.querySelectorAll('.media-tab-btn');

    tabButtons.forEach(button => {

        if (button.getAttribute('data-type') === currentMedia) {
            button.classList.add('btn-light');
            button.classList.remove('btn-outline-light');
        }

        button.addEventListener('click', function () {
            tabButtons.forEach(btn => btn.classList.remove('btn-light'));
            tabButtons.forEach(btn => btn.classList.add('btn-outline-light'));

            this.classList.add('btn-light');
            this.classList.remove('btn-outline-light');

            currentMedia = this.getAttribute('data-type');
            filterMediaSlides(currentMedia);
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initGiftSwiper();
    setupGiftTabs();
    filterGiftSlides('all');

    initWinnerSwiper();
    setupWinnerTabs();
    filterWinnerSlides('all');

    setupMediaTabs();
    filterMediaSlides('poster');
});




// const copyButtons = document.querySelectorAll('.copy-link');

// copyButtons.forEach(button => {
//     button.addEventListener('click', function () {
//         const link =  this.getAttribute('data-link');
//         const linkIcon = this.querySelector('.link-icon');
//         console.log(link);

//         const tempInput = document.createElement('input');
//         tempInput.value = link;
//         document.body.appendChild(tempInput);
//         tempInput.select();

//         try {

//             console.log(document.execCommand('copy'));

//             linkIcon.classList.add('copied');

//             setTimeout(() => {
//                 linkIcon.classList.remove('copied');
//             }, 1000);

//         } catch (err) {
//             console.error('خطا در کپی لینک:', err);
//             alert('خطا در کپی لینک');
//         }

//         document.body.removeChild(tempInput);
//     });
// });







var clipboard = new ClipboardJS('.btn_my_test');

clipboard.on('success', function (e) {

    document.querySelectorAll('.btn_my_test').forEach(button => {
        button.addEventListener('click', function () {
            const linkIcon = this.querySelector('.link-icon');

            linkIcon.classList.add('copied');

            setTimeout(() => {
                linkIcon.classList.remove('copied');
            }, 1000);

        });
    });


    console.info(e.text);
    e.clearSelection();
});

clipboard.on('error', function (e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
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

    $('#select2GiftList').select2({
        placeholder: 'حایزه را انتخاب کنید',
        dir: 'rtl',
        language: {
            noResults: function () {
                return 'نتیجه‌ای یافت نشد.';
            },
            searching: function () {
                return 'در حال جستجو...';
            }
        },
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




class HorizontalScroll {
    constructor(container) {
        this.container = container;
        this.isDown = false;
        this.startX;
        this.scrollLeft;
        
        this.init();
    }

    init() {
        this.container.style.overflow = 'hidden';
        this.container.style.cursor = 'grab';
        
        this.container.addEventListener('mousedown', this.mouseDown.bind(this));
        this.container.addEventListener('mouseleave', this.mouseLeave.bind(this));
        this.container.addEventListener('mouseup', this.mouseUp.bind(this));
        this.container.addEventListener('mousemove', this.mouseMove.bind(this));
        
        this.container.addEventListener('touchstart', this.touchStart.bind(this));
        this.container.addEventListener('touchend', this.touchEnd.bind(this));
        this.container.addEventListener('touchmove', this.touchMove.bind(this));
    }

    mouseDown(e) {
        this.isDown = true;
        this.container.style.cursor = 'grabbing';
        this.startX = e.pageX - this.container.offsetLeft;
        this.scrollLeft = this.container.scrollLeft;
    }

    mouseLeave() {
        this.isDown = false;
        this.container.style.cursor = 'grab';
    }

    mouseUp() {
        this.isDown = false;
        this.container.style.cursor = 'grab';
    }

    mouseMove(e) {
        if (!this.isDown) return;
        e.preventDefault();
        const x = e.pageX - this.container.offsetLeft;
        const walk = (x - this.startX) * 2; 
        this.container.scrollLeft = this.scrollLeft - walk;
    }

    touchStart(e) {
        this.isDown = true;
        this.startX = e.touches[0].pageX - this.container.offsetLeft;
        this.scrollLeft = this.container.scrollLeft;
    }

    touchEnd() {
        this.isDown = false;
    }

    touchMove(e) {
        if (!this.isDown) return;
        const x = e.touches[0].pageX - this.container.offsetLeft;
        const walk = (x - this.startX) * 2;
        this.container.scrollLeft = this.scrollLeft - walk;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const scrollContainer = document.querySelector('.overflow-x-auto.scroll-container');
    new HorizontalScroll(scrollContainer);
});