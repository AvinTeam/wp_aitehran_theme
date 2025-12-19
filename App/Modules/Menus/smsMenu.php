<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;
use TAI\App\Core\Traits\JDF;
use TAI\App\Options\SMSSetting;

( defined( 'ABSPATH' ) ) || exit;

class SMSMenu extends Menu {
    use JDF;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function admin_menu( string $context ): void {

        $suffix = add_menu_page(
            'پنل پیامک',
            'پنل پیامک',
            'manage_options',
            'tai-sms',
            array( $this, 'view' ),
            'dashicons-hammer',
            0
        );

        add_action( 'load-' . $suffix, array( $this, 'processing' ) );
    }

    public function view() {

        view( 'menus/sms/setting', SMSSetting::get() );
    }

    public function processing() {

        if (
            isset( $_POST[ 'act' ] ) &&
            "smsSettingSubmit" == $_POST[ 'act' ] &&
            wp_verify_nonce( $_POST[ '_wpnonce' ], config( 'app.key' ) . '_setting_' . get_current_user_id() )
        ) {

            if ( SMSSetting::set( $_POST[ "sms" ] ) ) {
                $this->success( 'تغییر با موفقیت انجام شد' );
            } else {
                $this->error( 'تغییرات ذخیره نشده است دوباره تلاش کنید' );
            }
        }
    }
}
