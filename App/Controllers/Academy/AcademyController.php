<?php
namespace TAI\App\Controllers\Academy;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Academy\AcademyServices;

( defined( 'ABSPATH' ) ) || exit;

class AcademyController extends Controller {

    protected $services;

    public function __construct() {

        $this->services = new AcademyServices();
    }

    public function content() {
        view( 'academy/single/content', array( "video" => $this->services->get_video() )

        );
    }

    public function sidebar() {
        view( 'academy/single/sidebar' );
    }
    public function sidebar_archive() {

        view( 'academy/archive/sidebar',
            $this->services->sidebar() );

    }
    public function archive() {
        view( 'academy/archive/content', $this->services->archive() );

    }
    public function taxonomy() {
        view( 'academy/archive/content', $this->services->taxonomy() );

    }

}
