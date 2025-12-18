<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;
use TAI\App\Core\Traits\JDF;
use TAI\App\Models\Contact;
use TAI\App\Modules\ListTable\ContactsListTable;
use TAI\App\Options\GeneralSetting;

( defined( 'ABSPATH' ) ) || exit;

class smsMenu extends Menu {
    use JDF;

    public function __construct() {
        // add_action( 'admin_menu', array( $this, 'admin_menu' ) );
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

        $showList = true;

        if ( isset( $_GET[ 'id' ] ) && absint( $_GET[ 'id' ] ) ) {
            $massage = Contact::find( absint( $_GET[ 'id' ] ) );

            if ( $massage ) {
                $showList = false;
                $massage  = $massage->toArray();

                $massage[ 'date' ] = $this->date( $massage[ 'created_at' ], 'date' );
                $massage[ 'time' ] = to_persian( $this->date( $massage[ 'created_at' ], 'time' ) );

                if ( "noRead" == $massage[ 'status' ] ) {
                    Contact::find( absint( $_GET[ 'id' ] ) )->update( array( 'status' => 'read' ) );
                }

                view( 'menus/contacts/massage', $massage );
            }
        }

        if ( $showList ) {
            view( 'menus/contacts/list', array(
                'table' => new ContactsListTable(),
            ) );
        }
    }

    public function processing() {

        if ( isset( $_POST[ 'act' ] ) && "settingSubmit" == $_POST[ 'act' ] && wp_verify_nonce( $_POST[ '_wpnonce' ], config( 'app.key' ) . '_setting_' . get_current_user_id() ) ) {
            if ( GeneralSetting::set( $_POST[ "setting" ] ) ) {
                $this->success( 'تغییر با موفقیت انجام شد' );
            } else {
                $this->error( 'تغییرات ذخیره نشده است دوباره تلاش کنید' );
            }
        }
    }
}
