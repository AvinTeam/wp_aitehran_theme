<?php
namespace TAI\App\Controllers\Home;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Home\HomeServices;

( defined( 'ABSPATH' ) ) || exit;

class HomeController extends Controller {

    protected $services;

    public function __construct() {

        $this->services = new HomeServices();

    }

    public function heroSection() {
        view( 'home/heroSection',
            $this->services->heroSection()
        );

    }
    public function format() {
        view( 'home/format',
            $this->services->format() );

    }
    public function news( $title, $color, $category ) {
        view( 'home/news', array(
            "title" => $title,
            "color" => $color,
            "items" => $this->services->tai_get_posts_by_category( $category ),
        )
        );

    }
    public function gallery() {
        view( 'home/gallery', array(
            "items" => $this->services->tai_get_posts_by_category("gallery"),
        )
        );

    }
    public function videos() {
        view( 'home/videos', array(
            "items" => $this->services->videos(),
        )
        );

    }

}
