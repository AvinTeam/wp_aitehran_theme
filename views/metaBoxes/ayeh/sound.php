<style>
.w-100.tai-row-meta-box span {
    width: 20px;
}
</style>
<div id="sound_list">
    <?php $m = 0;foreach ($sound_list as $sound): ?>

    <div class="tai-row-meta-box w-100 parent-row">
        <div class="w-100">
            <div class="w-100 tai-row-meta-box">
                <span>قاری</span>
                <input name="ayeh[sound][<?php echo $m ?>][title]" value="<?php echo $sound[ 'title' ] ?>" class="w-100"
                    placeholder="قاری">
            </div>
            <div class="w-100 tai-row-meta-box">
                <span>توضیحات</span>
                <textarea name="ayeh[sound][<?php echo $m ?>][description]" id="description" rows="5" class="w-100"
                    placeholder="توضیحات"><?php echo $sound[ 'description' ]?? "" ?></textarea>
            </div>
            <div class="w-100 tai-row-meta-box">
                <span>لینک</span>
                <input name="ayeh[sound][<?php echo $m ?>][link]" value="<?php echo $sound[ 'link' ] ?>" id="link"
                    class="w-100 d-ltr" placeholder="لینک">
                <button type="button" class="button add_sound">آپلود صوت</button>
            </div>
            <section class="d-flex align-items-center gap-3">
                <div>
                    <span>تصویر قاری</span>
                    <input type="hidden" name="ayeh[sound][<?php echo $m ?>][image]"
                        value="<?php echo absint($sound[ 'image' ]) ?>">
                    <p class="d-flex flex-row justify-content-start gap-1">
                        <button type="button" class="button button-secondary select_gallery" data-title="انتخاب تصویر قاری"
                            data-buttontext="انتخاب تصویر" data-type="image">انتخاب</button>

                        <button type="button" action="clean" class="button button-error "
                            style="<?php echo(! absint($sound[ 'image' ])) ? ' display: none;' : '' ?>">حذف</button>
                    </p>
                </div>

                <img src="<?php echo $sound[ 'imageUrl' ] ?>"
                    style="max-height: 100px; width: auto;<?php echo(! absint($sound[ 'image' ])) ? ' display: none;' : '' ?>">
            </section>


































        </div>
        <button type="button" class="button button-error tai_btn_remove">حذف</button>
    </div>
    <?php $m++;endforeach; ?>
</div>
<div class="tai-row-meta-box w-100">
    <button type="button" id="tai-add-sound" data-nextItem="<?php echo $m ?>"
        class="button button-success button-large ">افزودن</button>
</div>