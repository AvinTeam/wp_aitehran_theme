<?php
    (defined('ABSPATH')) || exit;
    global $title;

?>

<div class="wrap tai_menu">
    <h1><?php echo esc_html($title) ?></h1>

    <form method="post" action="" novalidate="novalidate">
        <?php wp_nonce_field(config('app.key') . '_supporters_list_setting_' . get_current_user_id()); ?>


        <div class="gallery-management-container">

            <ul id="gallery-images-list" class="sortable-list">
                <?php foreach ($image_ids as $image): ?>
                <li class="image-item" data-id="<?php echo esc_attr($image); ?>">
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($image, 'full')); ?>" />
                    <a href="#" class="remove-image">حذف</a>
                </li>
                <?php endforeach; ?>
            </ul>

            <button id="upload-gallery-images" class="button">
                افزودن عکس‌ها
            </button>



            <input type="hidden" id="tai_galleries" name="image_ids"
                value="<?php echo esc_attr($gallery_images); ?>" />

            <button type="submit" name="act" id="submit" value="update_supporters_list"
                class="button button-primary">ذخیرهٔ
                تغییرات</button>



        </div>
    </form>
</div>