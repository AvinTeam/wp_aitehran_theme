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
    }

});

jQuery(document).ready(function ($) {
    // $("#download_app").modal("show");



    // $("form#art_info").submit(function (e) {
    //     e.preventDefault();


    //     $formDiv = "form#art_info";

    //     let is_true = true;



    //     const format_art = $($formDiv + " input[name=format_art]:checked").val();
    //     if (!format_art && !Number(format_art) && is_true) {
    //         is_true = false
    //         setToastDanger("قالب اثر را وارد کنید");

    //     }

    //     const art_title = $($formDiv + " input[name=art_title]").val();

    //     if (!art_title && is_true) {
    //         is_true = false
    //         setToastDanger("عنوان اثر را وارد کنید");

    //     }

    //     const subject_art = $($formDiv + " input[name=subject_art]:checked").val();
    //     if (!subject_art && !Number(subject_art) && is_true) {
    //         is_true = false
    //         setToastDanger("موضوع اثر را وارد کنید");

    //     }




    //     if (is_true) {

    //         startLoading();
    //     }
    // });



    $('#add_teem').click(function (e) {
        e.preventDefault();

        let nextItems = document.querySelectorAll('#teem-list div.team-item').length;

        if (nextItems <= 3) {
            $('#teem-list').append(`
            <div class="w-100 d-flex flex-row justify-content-between align-items-center my-2 gap-2 team-item">
                <input type="text" name="teem[]" value=""class="form-control text-primary w-100 fw-bold f-24"placeholder="نام و نام خانوادگی عوامل تولید">
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
