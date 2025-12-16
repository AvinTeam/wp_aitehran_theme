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
            "first_name"  => sanitize_text_field( $request[ 'firstName' ] ),
            "last_name"   => sanitize_text_field( $request[ 'lastName' ] ),
            "mobile"      => sanitize_phone( $request[ 'mobile' ] ),
            "description" => sanitize_textarea_field( $request[ 'description' ] ),
        ) );

        return array(
            "massage" => ( $contact ) ? "پیام شما با موفقیت ثبت شد" : "ارسال پیام به خطا خورده است دوباره تلاش  کنید",
            "success" => ( $contact ) ? true : false,

        );

    }

    public function count( $request ) {

        $allContact = Contact::all();

        return $allContact->count();

    }

}
