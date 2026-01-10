document.getElementById('fileInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const maxSizeMB = 700;
    const maxSizeBytes = maxSizeMB * 1024 * 1024;

    if (file && file.size > maxSizeBytes) {

        setToastDanger(`سایز فایل نباید بیشتر از ${maxSizeMB} مگابایت باشد.`)
        event.target.value = '';
        return;
    }

    if (file) {
        const allowedExtensions = ['.zip', '.rar', '.7zip'];
        const fileName = file.name.toLowerCase();
        const isValidExtension = allowedExtensions.some(ext => fileName.endsWith(ext));

        if (!isValidExtension) {
            setToastDanger('فقط فایل‌های zip, rar, 7zip مجاز هستند.')

            event.target.value = '';
            return;
        }

        const toastBody = document.getElementById('preview_art');

        toastBody.innerHTML = "";
        toastBody.innerHTML = `        
                <div class="text-nowrap p-2 fw-bold f-20 text-primary w-100">
                    <span class="text-secondary me-2">فایل : </span>
                    <span>${fileName}</span>
                </div>`;
    }



});

jQuery(document).ready(function ($) {
    // $("#download_app").modal("show");



    $("form#art_info").submit(function (e) {
        e.preventDefault();

        $formDiv = "form#art_info";

        if (!tai_js.game_status) {
            setToastDanger("فرصت ارسال یا ویرایش آثار به اتمام رسید است");
            return;

        }


        const format_art = $($formDiv + " select[name=format_art]").val();
        if (!Number(format_art)) {
            setToastDanger("قالب اثر را وارد کنید");
            return;

        }
        const art_title = $($formDiv + " input[name=art_title]").val();
        if (art_title == "") {
            setToastDanger("عنوان اثر را وارد کنید");
            return;

        }

        const subject_art = $($formDiv + " select[name=subject_art]").val();
        if (!Number(subject_art)) {
            setToastDanger("موضوع اثر را وارد کنید");
            return;

        }

        const year = $($formDiv + " select[name=year]").val();

        if (!Number(year)) {
            setToastDanger("سال تولید اثر را وارد کنید");
            return;

        }

        const inputs = $('#teem-list input[name="teem[]"]');

        // if (inputs.length < 1) {
        //     setToastDanger('حداقل یک عامل تولید باید وارد شود.');
        //     return;

        // }

        let hasEmpty = false;

        inputs.each(function () {
            if ($.trim($(this).val()) === '') {
                hasEmpty = true;
            }
        });

        if (hasEmpty) {
            setToastDanger('نام و نام خانوادگی تمام عوامل تولید باید تکمیل شود.');
            return;

        }

        const ownership = $($formDiv + " input[name=ownership]:checked").val();

        if (ownership == "legal") {
            const ownership_name = $($formDiv + " input[name=ownership_name]").val();
            if (ownership_name == "") {
                setToastDanger("نام شرکت یا نهاد حقوقی صاحب اثر را وارد کنید");
                return;

            }
        }

        const documentation = $('#documentation input[type=file]');

        let isValid = true;

        documentation.each(function () {
            if (this.files.length === 0) {
                isValid = false;
           
                return false;
            }
        });

        if (!isValid || documentation.length < 1) {
             setToastDanger('مستندات تولید باید وارد شود.');
            return;  
        }


        const fileInput = $('#fileInput')[0];

        if ((!fileInput.files || fileInput.files.length === 0)) {
            let countFileArt = document.querySelectorAll('a.file_art').length;
            if (!countFileArt) {

                setToastDanger('لطفاً فایل اثر خود انتخاب کنید.');
                return;

            }
        }

        startLoading();
        this.submit();
    });



    $('#add_teem').click(function (e) {
        e.preventDefault();

        let nextItems = document.querySelectorAll('#teem-list div.team-item').length;

        if (nextItems <= 3) {
            $('#teem-list').append(`
            <div class="w-100 d-flex flex-row justify-content-between align-items-center my-2 gap-2 team-item">
                <input type="text" name="teem[]" value=""class="form-control text-primary w-100 fw-bold f-24 only-fa" placeholder="نام و نام خانوادگی عوامل تولید">
                <button onclick="this.closest('div').remove()" type="button"class="btn btn-danger btn-lg">حذف</button>
            </div>

        `);
        }
    });

    let item = 0;
    $('#add_document').click(function (e) {
        e.preventDefault();
        $('#documentation').append(`            
                <div class="w-100 d-flex flex-row justify-content-between align-items-center my-2 gap-2">
                    <input type="file" name="documentation${item}" accept=".zip,.rar,.7zip" class="form-control text-primary w-100 fw-bold f-24">
                    <button onclick="this.closest('div').remove()" type="button" class="btn btn-danger btn-lg">حذف</button>
                </div>
        `);
        item++;
    });


    $(document).on('click', '#remove-document', function (e) {
        e.preventDefault();
        $(this).parent().remove();
        var imageIds = [];
        $('#documentation .image-document').each(function () {
            imageIds.push($(this).data('id'));
        });
        $('#tai-document').val(imageIds.join(','));
    });













});
