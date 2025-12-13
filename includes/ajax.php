<?php

// add_action('wp_ajax_nopriv_tai_logout', 'tai_logout');
// add_action('wp_ajax_tai_logout', 'tai_logout');

// function tai_logout()
// {
//     wp_logout();
//     wp_send_json_success(home_url());
// }

// ثبت AJAX برای ذخیره گالری
add_action('wp_ajax_save_tai_galleries', 'tai_galleries');

function tai_galleries()
{
    check_ajax_referer('ajax-nonce', 'security');

    if (! current_user_can('manage_options')) {
        wp_send_json_error('دسترسی غیرمجاز!');
    }

    if (isset($_POST[ 'image_ids' ])) {
        update_option($_POST[ 'gallery_type' ], sanitize_text_field($_POST[ 'image_ids' ]));
        wp_send_json_success('ذخیره شد!');
    }

    wp_send_json_error('خطا در ذخیره‌سازی!');
}
