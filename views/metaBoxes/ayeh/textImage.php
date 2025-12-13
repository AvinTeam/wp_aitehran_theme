<section class="d-flex flex-row justify-content-between">

    <div>


        <label>توضیحات</label>

        <textarea name="ayeh[text_image][description]" id="description" rows="5" class="w-100"
            placeholder="توضیحات"><?php echo $description ?? "" ?></textarea>

        <label>تصویر</label>
        <input type="hidden" name="ayeh[text_image][image]" value="<?php echo $image?? '' ?>" />

        <p>
            <button type="button" class="button button-secondary select_gallery" data-title="انتخاب تصویر"
                data-buttonText="انتخاب تصویر" data-type="image">انتخاب</button>

            <button type="button" action="clean" class="button button-error "
                style="<?php echo ! $image ? 'display: none;' : ''; ?>">حذف</button>
        </p>
    </div>
    <img src="<?php echo $imageUrl ?>"
        style="width: 200px; height: auto;<?php echo ! $image ? 'display: none;' : ''; ?>" />

</section>