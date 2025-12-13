    <?php
        (defined('ABSPATH')) || exit;
        global $title;
        $m = 0;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html($title) ?></h1>

        <form method="post" id="statistics-form">
            <?php wp_nonce_field(config('app.key') . '_statistics_setting_' . get_current_user_id()); ?>
            <div class="draggable-list" id="statistics-list">

                <?php foreach ($list ?? [  ] as $item): ?>
                <div class="draggable-item" draggable="true">
                    <div class="draggable-handle dashicons dashicons-move"></div>
                    <button type="button" class="remove-draggable text-error button-link dashicons dashicons-trash"
                        onclick="this.closest('.draggable-item').remove()"></button>

                    <div class="draggable-fields" style="grid-template-columns: 2fr 1fr auto !important;">
                        <div>
                            <label>عنوان</label>
                            <input class="w-100" type="text" name="statistics[<?php echo $m ?>][title]"
                                value="<?php echo $item[ 'title' ] ?? '' ?>">

                            <label>تعداد</label>
                            <input class="w-100" type="text" name="statistics[<?php echo $m ?>][number]"
                                value="<?php echo $item[ 'number' ] ?? '' ?>">

                            <label>لینک</label>
                            <input class="w-100" type="url" name="statistics[<?php echo $m ?>][link]"
                                value="<?php echo $item[ 'link' ] ?? '' ?>">
                        </div>
                        <section class="d-flex flex-row justify-content-between">
                            <div>
                                <label>تصویر</label>
                                <input type="hidden" name="statistics[<?php echo $m ?>][image]"
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

            <button type="button" id="add-statistics" class="button" data-nextitem="<?php echo $m ?>">+ افزودن
                جدید</button>


            <button type="submit" name="act" value="submit_statistics" class="button button-primary">ذخیره
                تغییرات</button>
        </form>


    </div>