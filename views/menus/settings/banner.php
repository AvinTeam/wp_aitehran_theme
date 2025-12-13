    <?php
        (defined('ABSPATH')) || exit;
        global $title;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html($title) ?></h1>

        <form method="post" id="banner-form">
            <?php wp_nonce_field(config('app.key') . '_banner_setting_' . get_current_user_id()); ?>

            <div class="draggable-list" id="banner-list">
                <?php $m = 0;foreach ($items as $item): ?>

                <div class="draggable-item" draggable="true">
                    <div class="draggable-handle dashicons dashicons-move"></div>
                    <button type="button"
                        class="remove-draggable text-error button-link dashicons dashicons-trash"
                         onclick="this.closest('.draggable-item').remove()" ></button>

                    <div class="draggable-fields">
                        <section class="d-flex flex-row justify-content-between">
                            <div>
                                <label>تصویر</label>
                                <input type="hidden" name="banner[<?php echo $m ?>][image]" value="<?php echo $item[ 'id' ] ?>" />

                                <p>
                                    <button type="button" class="button button-secondary select_gallery"
                                        data-title="انتخاب تصویر" data-buttonText="انتخاب تصویر"
                                        data-type="image">انتخاب</button>

                                    <button type="button" action="clean" class="button button-error "
                                        style="<?php echo ! $item[ 'id' ] ? 'display: none;' : ''; ?>">حذف</button>
                                </p>
                            </div>
                            <img src="<?php echo $item[ 'url' ] ?>" style="max-height: 100px; width: auto;<?php echo ! $item[ 'id' ] ? 'display: none;' : ''; ?>" />

                        </section>
                        <div>
                            <label>لینک</label>
                            <input class="d-ltr w-100" type="text" name="banner[<?php echo $m ?>][link]" value="<?php echo $item[ 'link' ] ?>">
                        </div>
                    </div>
                </div>
                <?php $m++;endforeach; ?>
            </div>

            <button type="button" id="add-banner" class="button" data-nextitem="<?php echo $m ?>">+ افزودن
                جدید</button>


            <button type="submit" name="act" value="update_banner_header" class="button button-primary"
                data-nextitem="<?php echo $m ?>">ذخیره تغییرات</button>
        </form>
    </div>