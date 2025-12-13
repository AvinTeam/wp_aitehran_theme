    <?php
        (defined('ABSPATH')) || exit;
        global $title;
        $m = 0;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html($title) ?></h1>



        <h2>کد ساعت شمار:</h2>
        <ul>
            <li>برای مسابقه اینترنتی <code>internet</code></li>
            <li>برای مسابقه تلوزیونی <code>tv</code></li>
        </ul>

        <hr>
        <br>
        <form method="post" id="works-form">
            <?php wp_nonce_field(config('app.key') . '_works_list_setting_' . get_current_user_id()); ?>
            <div class="draggable-list" id="works-list">
                <?php foreach ($list ?? [  ] as $item): ?>
                <div class="draggable-item" draggable="true">
                    <div class="draggable-handle dashicons dashicons-move"></div>
                    <button type="button" class="remove-draggable text-error button-link dashicons dashicons-trash"
                        onclick="this.closest('.draggable-item').remove()"></button>

                    <div class="draggable-fields" style="grid-template-columns: 2fr 1fr auto !important;">
                        <div>
                            <label>عنوان</label>
                            <input class="w-100" type="text" name="works[<?php echo $m ?>][title]"
                                value="<?php echo $item[ 'title' ] ?? '' ?>">

                            <label>توضیحات</label>
                            <textarea class="w-100" rows="5" type="text"
                                name="works[<?php echo $m ?>][description]"><?php echo $item[ 'description' ] ?? '' ?></textarea>

                            <label>عنوان دکمه</label>
                            <input class="w-100" type="text" name="works[<?php echo $m ?>][btn_title]"
                                value="<?php echo $item[ 'btn_title' ] ?? '' ?>">

                            <label>لینک</label>
                            <input class="d-ltr w-100" type="text" name="works[<?php echo $m ?>][link]"
                                value="<?php echo $item[ 'link' ] ?? '' ?>">

                            <label>کد ساعت شمار</label>
                            <input class="d-ltr w-100" type="text" name="works[<?php echo $m ?>][shortcode]"
                                value="<?php echo $item[ 'shortcode' ] ?? '' ?>">
                        </div>
                        <section class="d-flex flex-row justify-content-between">
                            <div>
                                <label>تصویر</label>
                                <input type="hidden" name="works[<?php echo $m ?>][image]"
                                    value="<?php echo $item[ 'id' ] ?>" />
                                <p>
                                    <button type="button" class="button button-secondary select_gallery"
                                        data-title="انتخاب تصویر" data-buttonText="انتخاب تصویر"
                                        data-type="image">انتخاب</button>

                                    <button type="button" action="clean" class="button button-error "
                                        style="<?php echo ! $item[ 'id' ] ? 'display: none;' : ''; ?>">حذف</button>
                                </p>
                            </div>
                            <img src="<?php echo $item[ 'url' ] ?>"
                                style="max-height: 100px; width: auto;<?php echo ! $item[ 'id' ] ? 'display: none;' : ''; ?>" />
                        </section>
                    </div>
                </div>

                <?php $m++;endforeach; ?>
            </div>

            <button type="button" id="add-works" class="button" data-nextitem="<?php echo $m ?>">+ افزودن
                جدید</button>


            <button type="submit" name="act" value="update_works_list" class="button button-primary">ذخیره
                تغییرات</button>
        </form>


    </div>