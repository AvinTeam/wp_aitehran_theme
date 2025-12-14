<?php
namespace TAI\App\Services\Home;

use TAI\App\Options\GeneralSetting;
use TAI\App\Services\Service;

( defined( 'ABSPATH' ) ) || exit;

class HomeServices extends Service {

    private $setting  = array();
    private $sections = array();

    public function __construct() {
        $this->setting  = GeneralSetting::get();
        $this->sections = get_option( 'tai_sections', array() );
    }

    public function heroSection() {

        $title = preg_replace( '/##(.+?)##/', '<span class="text-gold-gradient">$1</span>', ( $this->setting[ 'heroTitle' ] ?? '' ) );

        return array(
            'title'       => $title,
            'description' => $this->setting[ 'heroDescription' ] ?? '',

        );
    }

    public function format() {

        $formats = array_map( "basename", glob( TAI_PATH . 'assets/image/formats/*' ) );

        return array(

            "formats" => $formats,

         );
    }
}
