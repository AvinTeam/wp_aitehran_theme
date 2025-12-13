
<div id="video_list">
    <div class="zba-row-meta-box w-100  parent-row">
        <div class="w-100 d-flex flex-row justify-content-between align-items-center">


            <div class="w-100 zba-row-meta-box d-flex flex-row justify-content-start align-items-center gap-2">
                <span>لینک</span>
                <input name="academy[video]" value="<?php echo $video ?>" id="link" class="regular-text d-ltr"
                    placeholder="لینک">
                <button type="button" class="button add_video">آپلود ویدئو</button>
            </div>

            <section class="d-flex align-items-center gap-3">
                <div>
                    <span>پوستر ویدئو</span>
                    <input type="hidden" name="academy[image]" value="<?php echo absint( $image ) ?>">
                    <p class="d-flex flex-row justify-content-start gap-1">
                        <button type="button" class="button button-secondary select_gallery"
                            data-title="انتخاب پوستر ویدئو" data-buttontext="انتخاب تصویر"
                            data-type="image">انتخاب</button>

                        <button type="button" action="clean" class="button button-error "
                            style="<?php echo( ! absint( $image ) ) ? ' display: none;' : '' ?>">حذف</button>
                    </p>
                </div>

                <img src="<?php echo $imageUrl ?>"
                    style="max-height: 100px; width: auto;<?php echo( ! absint( $image ) ) ? ' display: none;' : '' ?>">
            </section>
        </div>
    </div>
</div>