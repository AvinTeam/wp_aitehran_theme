<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;
use TAI\App\Core\Traits\JDF;
use TAI\App\Options\SMSSetting;

( defined( 'ABSPATH' ) ) || exit;

class GameSettingMenu extends Menu {
    use JDF;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function admin_menu( string $context ): void {

        $suffix = add_menu_page(
            'تنظیمات مسایقه',
            'تنظیمات مسایقه',
            'manage_options',
            'tai-game',
            array( $this, 'view' ),
            'dashicons-hammer',
            0
        );

        add_action( 'load-' . $suffix, array( $this, 'processing' ) );
    }

    public function view() {

        $game = get_option( 'tai_game_settings', array() );

        view( 'menus/game/setting', [
            "status" => $game[ 'status' ] ?? false,

        ] );
    }

    public function processing() {

        if (
            isset( $_POST[ 'act' ] ) &&
            "gameSettingSubmit" == $_POST[ 'act' ] &&
            wp_verify_nonce( $_POST[ '_wpnonce' ], config( 'app.key' ) . '_setting_' . get_current_user_id() )
        ) {


            if (   update_option( 'tai_game_settings', $_POST[ "game" ]??[] ) ) {
                $this->success( 'تغییر با موفقیت انجام شد' );
            } else {
                $this->error( 'تغییرات ذخیره نشده است دوباره تلاش کنید' );
            }
        }
    }
}
