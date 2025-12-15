<?php
namespace TAI\App\Controllers\Contacts;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Contacts\ContactsServices;

( defined( 'ABSPATH' ) ) || exit;

class ContactsController extends Controller {

    protected $services;

    public function __construct() {
        $this->services = new ContactsServices();
    }

    public function create( $request ) {

        return $this->services->create( $request );



    }

}
