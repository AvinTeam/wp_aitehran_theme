<div class="gallery-management-container">

    <ul id="gallery-images-list" class="sortable-list">
        <?php foreach ($poster_images as $image): ?>
        <li class="image-item" data-id="<?php echo esc_attr($image); ?>">
            <img src="<?php echo esc_url(wp_get_attachment_image_url($image, 'full')); ?>" />
            <a href="#" class="remove-image">حذف</a>
        </li>
        <?php endforeach; ?>
    </ul>

    <button id="upload-gallery-images" class="button button-primary">
        افزودن عکس‌ها
    </button>
    <input type="hidden" id="tai_galleries" name="ayeh[poster]" value="<?php echo esc_attr($poster_ids); ?>" />
</div>