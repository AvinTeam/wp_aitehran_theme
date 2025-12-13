    <?php
        (defined('ABSPATH')) || exit;
        global $title;

    ?>
    <div class="wrap">
        <h1><?php echo esc_html($title) ?></h1>

        <h2>استفاده برای لینک</h2>
        <code>[tai_link link="" title="" ]</code>
        <hr>
        <br>

        <form method="post" id="faqs-form">
            <?php wp_nonce_field(config('app.key') . '_setting_' . get_current_user_id()); ?>

            <div class="draggable-list" id="faqs-list">
                <?php $m = 0;foreach ($list as $faq): ?>
                <div class="draggable-item" draggable="true">
                    <div class="draggable-handle dashicons dashicons-move"></div>
                    <button type="button"
                        class="remove-draggable text-error button-link dashicons dashicons-trash"></button>

                    <div class="draggable-fields">
                        <div>
                            <label>سوال</label>
                            <input type="text" name="faq[<?php echo $m ?>][question]"
                                value="<?php echo $faq[ 'question' ] ?>">

                            <label>پاسخ</label>
                            <textarea name="faq[<?php echo $m ?>][answer]"
                                rows="5"><?php echo $faq[ 'answer' ] ?></textarea>
                        </div>
                    </div>
                </div>
                <?php $m++;endforeach; ?>
            </div>


            <button type="button" id="add-faq" class="button" data-nextitem="<?php echo $m ?>">+ افزودن
                جدید</button>


            <button type="submit" name="act" value="update_faqs" class="button button-primary">ذخیره تغییرات</button>
        </form>


    </div>