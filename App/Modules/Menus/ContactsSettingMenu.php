<?php
namespace TAI\App\Modules\Menus;

use TAI\App\Core\Menu;
use TAI\App\Core\Traits\JDF;
use TAI\App\Models\Contact;
use TAI\App\Modules\ListTable\ContactsListTable;
use TAI\App\Options\GeneralSetting;

( defined( 'ABSPATH' ) ) || exit;

class ContactsSettingMenu extends Menu {
    use JDF;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function admin_menu( string $context ): void {

        $contactsCount = absint( Contact::allStatusCount( "noRead" ) );
        $showUi        = '';

        if ( $contactsCount ) {
            $showUi = '<span class="update-plugins"><span class="plugin-count">' . $contactsCount . '</span></span>';
        }

        $suffix = add_menu_page(
            'ارتباط با ما',
            'ارتباط با ما ' . $showUi,
            'manage_options',
            'tai-contacts-us',
            array( $this, 'view' ),
            "dashicons-email-alt",
            26
        );

        add_action( 'load-' . $suffix, array( $this, 'processing' ) );
    }

    public function view() {

        $showList = true;

        if ( isset( $_GET[ 'id' ] ) && absint( $_GET[ 'id' ] ) ) {
            $massage = Contact::find( absint( $_GET[ 'id' ] ) );

            if ( $massage ) {
                $showList = false;

                $massage = $massage->toArray();

                $massage['date']= $this->date($massage['created_at'], 'date');
                $massage['time']= to_persian($this->date($massage['created_at'], 'time'));

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
