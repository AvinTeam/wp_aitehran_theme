<style>
#video_list .w-100.tai-row-meta-box span {
    width: 60px;
}

.parent-row {
    border-bottom: 1px solid #5d5c5cff;
    padding-bottom: 10px;
    margin-bottom: 5px;

}
</style>
<div id="video_list">
    <?php $m = 0;foreach ($video_list as $video): ?>
    <div class="tai-row-meta-box w-100  parent-row">
        <div class="w-100">
            <div class="w-100 tai-row-meta-box">
                <span>عنوان</span>
                <input name="ayeh[video][<?php echo $m ?>][title]" value="<?php echo $video[ 'title' ] ?>" class="w-100"
                    placeholder="عنوان">
            </div>
            <div class="w-100 tai-row-meta-box">
                <span>توضیحات</span>
                <textarea name="ayeh[video][<?php echo $m ?>][description]" id="description" rows="5" class="w-100"
                    placeholder="توضیحات"><?php echo $video[ 'description' ]?? "" ?></textarea>
            </div>
            <div class="w-100 tai-row-meta-box">
                <span>لینک</span>
                <input name="ayeh[video][<?php echo $m ?>][link]" value="<?php echo $video[ 'link' ] ?>" id="link"
                    class="w-100 d-ltr" placeholder="لینک">
                <button type="button" class="button add_video">آپلود ویدئو</button>
            </div>

            <section class="d-flex align-items-center gap-3">
                <div>
                    <span>پوستر ویدئو</span>
                    <input type="hidden" name="ayeh[video][<?php echo $m ?>][image]"
                        value="<?php echo absint($video[ 'image' ]) ?>">
                    <p class="d-flex flex-row justify-content-start gap-1">
                        <button type="button" class="button button-secondary select_gallery" data-title="انتخاب پوستر ویدئو"
                            data-buttontext="انتخاب تصویر" data-type="image">انتخاب</button>

                        <button type="button" action="clean" class="button button-error "
                            style="<?php echo(! absint($video[ 'image' ])) ? ' display: none;' : '' ?>">حذف</button>
                    </p>
                </div>

                <img src="<?php echo $video[ 'imageUrl' ] ?>"
                    style="max-height: 100px; width: auto;<?php echo(! absint($video[ 'image' ])) ? ' display: none;' : '' ?>">
            </section>
        </div>
        <button type="button" class="button button-error tai_btn_remove">حذف</button>
    </div>
    <?php $m++;endforeach; ?>
</div>
<div class="tai-row-meta-box w-100">
    <button type="button" id="tai-add-video" class="button button-success button-large "
        data-nextItem="<?php echo $m ?>">افزودن</button>
</div>