<?php
namespace TAI\App\Controllers\Panel;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Panel\PanelServices;

( defined( 'ABSPATH' ) ) || exit;

class PanelController extends Controller {

    protected $services;

    public function __construct() {

        $this->services = new PanelServices();

    }

    

    public function dashboard() {
        return $this->services->dashboard();
    }
    
    public function update($request) {
        return $this->services->update($request);
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
        view( 'academy/archive/content',
            array( "items" => $this->services->archive() ) );

    }

}
