<?php
namespace TAI\App\Services\Contacts;

use TAI\App\Models\Contact;
use TAI\App\Services\Service;

( defined( 'ABSPATH' ) ) || exit;

class ContactsServices extends Service {

    public function __construct() {

    }

    public function create( $request ) {

        $contact = Contact::create( array(
            "first_name"  => $request[ 'firstName' ],
            "last_name"   => $request[ 'lastName' ],
            "mobile"      => $request[ 'mobile' ],
            "description" => $request[ 'description' ],
        ) );

        return array(
            "massage" => ( $contact ) ? "پیام شما با موفقیت ثبت شد" : "ارسال پیام به خطا خورده است دوباره تلاش  کنید",
            "success" => ( $contact ) ? true : false,

        );

        // dd( $request );
        // view( 'home/heroSection',
        //     $this->services->heroSection()
        // );

    }

}
