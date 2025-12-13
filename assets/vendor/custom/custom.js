


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
        .then(result => result)
        .catch(error => console.log('error', error));
}

jQuery(document).ready(function ($) {

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });



    // ایجاد پلاگین modal برای jQuery
    (function ($) {
        // تعریف متد modal
        $.fn.modal = function (action) {
            // اگر action تعریف نشده باشد، مقدار پیش‌فرض toggle را می‌گیرد
            if (action === undefined) action = 'toggle';

            return this.each(function () {
                const $modal = $(this);
                const $backdrop = $('.modal-backdrop');

                switch (action) {
                    case 'show':
                        // نمایش backdrop
                        $backdrop.fadeIn(200);

                        // نمایش مودال
                        $modal.fadeIn(300);

                        // غیرفعال کردن اسکرول صفحه
                        $('body').css('overflow', 'hidden');
                        break;

                    case 'close':
                        // پنهان کردن مودال
                        $modal.fadeOut(300);

                        // پنهان کردن backdrop
                        $backdrop.fadeOut(300);

                        // فعال کردن اسکرول صفحه
                        $('body').css('overflow', 'auto');
                        break;

                    case 'toggle':
                        // تغییر وضعیت نمایش مودال
                        if ($modal.is(':visible')) {
                            $modal.modal('close');
                        } else {
                            $modal.modal('show');
                        }
                        break;
                }
            });
        };

        // بستن مودال با کلیک روی backdrop
        $(document).on('click', '.modal-backdrop', function () {
            $('.modal:visible').modal('close');
        });
        
        $(document).on('click', '.modal-close', function () {
            $('.modal:visible').modal('close');
        });

        $(document).on('click', '.modal-close', function () {
            $('.modal:visible').modal('close');
        });

        // بستن مودال با کلید ESC
        $(document).on('keyup', function (e) {
            if (e.key === "Escape") {
                $('.modal:visible').modal('close');
            }
        });

        // جلوگیری از بستن مودال با کلیک روی خود مودال
        $(document).on('click', '.modal', function (e) {
            e.stopPropagation();
        });

    }(jQuery));





    // // بستن مودال با کلیک روی دکمه بستن
    // $('.modal-close').click(closeModal);

    // // بستن مودال با کلیک روی overlay
    // $('#modalOverlay').click(function (e) {
    //     if ($(e.target).hasClass('modal-overlay')) {
    //         closeModal();
    //     }
    // });




})

