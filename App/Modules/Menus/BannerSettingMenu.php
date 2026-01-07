<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;

( defined( 'ABSPATH' ) ) || exit;

class BannerSettingMenu extends Menu {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function admin_menu( string $context ): void {

        $suffix = add_menu_page(
            'تصاویر قالب ها',
            'تصاویر قالب ها',
            'manage_options',
            'tai-format',
            array( $this, 'view' ),
            'dashicons-list-view',
            7
        );

        add_action( 'load-' . $suffix, array( $this, 'processing' ) );
    }

    public function view() {

        $banners = get_option( 'tai_banner' );

        if ( ! empty( $banners ) ) {
            $banners = unserialize( $banners );

            foreach ( $banners as $value ) {
                $items[  ] = array(
                    'id'   => $value[ 'image' ],
                    'url'  => get_the_image_url_by_id( $value[ 'image' ] ),
                    'link' => $value[ 'link' ],
                );
            }
        }

        view( 'menus/settings/banner', array(
            'items' => $items ?? array(),
        ) );
    }

    public function processing() {

        if ( isset( $_POST[ 'act' ] ) && "update_banner_header" == $_POST[ 'act' ] && wp_verify_nonce( $_POST[ '_wpnonce' ], config( 'app.key' ) . '_banner_setting_' . get_current_user_id() ) ) {
// $input[ 'googleMap' ] = sanitize_textarea_field( wp_unslash( $input[ 'googleMap' ] ) );

// $banner = array_map( function ( $item ) {

//     $item[ "link" ] = wp_unslash( $item[ "link" ] );

//     return serialize($item);

// }, $_POST[ 'banner' ] );

            if ( update_option( 'tai_banner', serialize( $_POST[ 'banner' ] ?? array() ) ) ) {
                $this->success( 'تغییر با موفقیت انجام شد' );
            } else {
                $this->error( 'تغییرات ذخیره نشده است دوباره تلاش کنید' );
            }
        }
    }
}
