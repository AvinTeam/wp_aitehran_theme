
jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});




jQuery(document).ready(function ($) {


    $(document).on('click', '.select_gallery', function (e) {
        const _this = this;
        e.preventDefault();

        var frame = wp.media({
            title: $(_this).attr('data-title') ?? 'انتخاب تصویر',
            button: {
                text: $(_this).attr('data-buttonText') ?? 'استفاده از این تصویر'
            },
            library: {
                type: [$(_this).attr('data-type')]
            },
            multiple: false
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $(_this).closest('section').find('input').val(attachment.id);
            $(_this).closest('section').find('img').attr('src', attachment.url).show()
            $(_this).closest('section').find('button[action="clean"]').show()
        });

        frame.open();
    });


    $(document).on('click', 'button[action="clean"]', function (e) {
        e.preventDefault();
        $(this).closest('section').find('input').val('');
        $(this).closest('section').find('img').hide().attr('src', '');
        $(this).hide();

    });


    $(document).on('click', '.add_video', function (e) {

        let _this = this;
        e.preventDefault();

        var mediaUploader = wp.media({
            title: 'انتخاب ویدئو برای آیه',
            button: { text: 'استفاده از این ویدئو' },
            multiple: false,
            library: {
                type: ['video']
            },
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $(_this).closest('div').find('input[id="link"]').val(attachment.url);
        });

        mediaUploader.open();
    });

    let nextItems = 0;
    $('.select-input button.add-item').click(function (e) {
        e.preventDefault();

        if (nextItems == 0) {
            nextItems = Number($(this).attr('data-nextItem'));
        }

        let itemType = $(this).attr('data-type');

        const options = Object.entries(tai_js[itemType]).map(([key, name]) => {
            return `<option value="${key}">${name}</option>`;
        });

        const optionsString = options.join('\n');

        $('#link-list').append(`
            <li>
                <select name="setting[${itemType}][${nextItems}][type]">
                    ${optionsString}
                </select>
                <input name="setting[${itemType}][${nextItems}][link]" type="url" class="regular-text">
                <button type="button" onclick="this.closest('li').remove()" class="button button-error">حذف</button>
            </li>
        `);
        nextItems++;
    });



    $('#format_artchecklist input').attr('type', 'radio');


    $('#subject_artchecklist input').attr('type', 'radio');


    var background_uploader;
    $('.select_images').click(function (e) {
        e.preventDefault();


        const _this = this;

        if (background_uploader !== undefined) {
            background_uploader.open();
            return;
        }

        background_uploader = wp.media({
            title: 'انتخاب تصویر',
            button: {
                text: 'انتخاب',
            },
            library: {
                type: ['image']
            }

        })


        background_uploader.on('select', function () {
            let selected = background_uploader.state().get('selection');

            let mat_utl = selected.first().toJSON().url;

            $(_this).parent('td').find('input').val(mat_utl);
            $(_this).parent('td').find('img').attr('src', mat_utl);


        });


        background_uploader.open();



    });


    $('.select_art_file').click(function (e) {
        e.preventDefault();


        const _this = this;

        if (background_uploader !== undefined) {
            background_uploader.open();
            return;
        }

        background_uploader = wp.media({
            title: 'انتخاب فایل اثر',
            button: {
                text: 'انتخاب',
            },

        })


        background_uploader.on('select', function () {
            let selected = background_uploader.state().get('selection');
            let matArtFile = selected.first().toJSON();
            $(_this).parent('.mat-select-file').find('input').val(matArtFile.id);
            $(_this).parent('.mat-select-file').find('a').attr('href', matArtFile.url);
            $(_this).parent('.mat-select-file').find('a').text(matArtFile.url);



        });


        background_uploader.open();



    });


    $(document).on("click", "#mat_btn_add", function (e) {
        e.preventDefault();
        //$('#parent_mat_btn_add').closest("tr").remove();
        const newRow = `
            <tr class="form-field form-required term-name-wrap">
                <th scope="row">
                    <button class="button button-danger mat_btn_remove" type="button" id="mat_btn_remove">حذف</button>
                </th>
                <td>

                    <table class="form-table" role="presentation">
                        <tbody>
                            <tr class="form-field term-slug-wrap">
                                <th scope="row"><label for="slug">سوال</label></th>
                                <td><input type="text" name="format_art_question[question][]" class="form-control" value="" />
                                </td>
                            </tr>
                            <tr class="form-field term-slug-wrap">
                                <th scope="row"><label for="slug">حداکثر امتیاز</label></th>
                                <td><input type="number" name="format_art_question[point][]" class="form-control" value="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr> `;

        $('#parent_mat_btn_add').before(newRow);
        //  $('#edittag .form-table tbody').append(newRow);
    });

    $(document).on("click", ".mat_btn_remove", function () {
        $(this).closest("tr").remove(); // حذف عنصر
    });

    $('.taxonomy-format_art #edittag').submit(function (e) {
        e.preventDefault();

        const _this = this;

        const inputs = $('input[type="text"][name="format_art_question[]"].form-control');
        const idTaxonomy = $('#id_taxonomy').val();

        const values = inputs.map(function () {
            return $(this).val();
        }).get();


        const formData = {
            action: 'mat_checked_question',
            questions: values,
            idTaxonomy: idTaxonomy,
            idTaxonomy: idTaxonomy,
        };
        $.ajax({
            url: mat_js.ajax_url,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                _this.submit();
            },
            error: function (response) {
                if (response.responseJSON !== undefined) {
                    if (response.responseJSON.data.code == 'soft_error') {
                        if (confirm(response.responseJSON.data.massage)) {
                            _this.submit();
                        }
                    }

                }
            }
        }); 2
    });

    $('#role').change(function (e) {
        e.preventDefault();



        let roleValue = $(this).val();

        console.log(roleValue);
        if (roleValue == "mat_referee") {

            $('.referee_selector').removeClass('mat-dn');
        } else {
            $('.referee_selector').addClass('mat-dn');

        }


        if (roleValue == "mat_referee" || roleValue == "mat_user") {

            $('.leader_roll_selector').removeClass('mat-dn');
        } else {
            $('.leader_roll_selector').addClass('mat-dn');

        }




    });



          let frame;

            $(".upload-category-image").on("click", function(e){
                e.preventDefault();

                if ( frame ) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: "انتخاب تصویر دسته‌بندی",
                    button: { text: "انتخاب" },
                    multiple: false
                });

                frame.on("select", function(){
                    const attachment = frame.state().get("selection").first().toJSON();
                    $("#category-image-id").val(attachment.id);
                    $("#category-image-preview").html("<img src=\'" + attachment.sizes.thumbnail.url + "\' style=\'max-width:150px;\'>");
                });

                frame.open();
            });

            $(".remove-category-image").on("click", function(){
                $("#category-image-id").val("");
                $("#category-image-preview").html("");
            });




});

