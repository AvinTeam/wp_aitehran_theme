<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;
use TAI\App\Options\GeneralSetting;

(defined('ABSPATH')) || exit;

class GeneralSettingMenu extends Menu
{
    public function __construct()
    {
        add_action('admin_menu', [ $this, 'admin_menu' ]);
    }

    public function admin_menu(string $context): void
    {

        $suffix = add_submenu_page(
            'options-general.php',
            'تنظیمات قالب',
            '* تنظیمات قالب',
            'manage_options',
            'tai-general-setting',
            [ $this, 'view' ],
        );

        add_action('load-' . $suffix, [ $this, 'processing' ]);

    }

    public function view()
    {

        view('menus/settings/general', GeneralSetting::get());
    }

    public function processing()
    {
        if (isset($_POST[ 'act' ]) && $_POST[ 'act' ] == "settingSubmit" && wp_verify_nonce($_POST[ '_wpnonce' ], config('app.key') . '_setting_' . get_current_user_id())) {

            if (GeneralSetting::set($_POST[ "setting" ])) {
                $this->success('تغییر با موفقیت انجام شد');
            } else {
                $this->error('تغییرات ذخیره نشده است دوباره تلاش کنید');
            }

        }
    }

}