<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;

(defined('ABSPATH')) || exit;

class SupportersSettingMenu extends Menu
{
    public function __construct()
    {
        add_action('admin_menu', [ $this, 'admin_menu' ]);
    }

    public function admin_menu(string $context): void
    {

        $suffix = add_submenu_page(
            'options-general.php',
            'گالری حامیان',
            '* گالری حامیان',
            'manage_options',
            'supporters-gallery',
            [ $this, 'view' ],
        );

        add_action('load-' . $suffix, [ $this, 'processing' ]);

    }

    public function view()
    {

        $gallery_images = get_option("supporters-gallery", '');

        // dd( $gallery_images);
        $image_ids      = explode(',', $gallery_images);

        view('menus/settings/supporters', [
            'image_ids'      => sanitize_no_item($image_ids),
            'gallery_images' => $gallery_images,

         ]);
    }

    public function processing()
    {
        if (isset($_POST[ 'act' ]) && $_POST[ 'act' ] == "update_supporters_list" && wp_verify_nonce($_POST[ '_wpnonce' ], config('app.key') . '_supporters_list_setting_' . get_current_user_id())) {

            if (update_option("supporters-gallery", sanitize_text_field($_POST[ 'image_ids' ]))) {
                $this->success('تغییر با موفقیت انجام شد');
            } else {
                $this->error('تغییرات ذخیره نشده است دوباره تلاش کنید');
            }

        }
    }

}
