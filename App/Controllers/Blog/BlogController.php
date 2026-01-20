<?php
namespace TAI\App\Controllers\Blog;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Blog\BlogServices;

( defined( 'ABSPATH' ) ) || exit;

class BlogController extends Controller {

    protected $services;

    public function __construct( array $result ) {

        $this->services = new BlogServices( $result );

    }

    public function pagination() {
        $this->services->pagination();

    }

    public function content() {
        view( 'post/single/content', array( "video" => $this->services->get_video() )

        );
    }

    public function sidebar() {
        view( 'post/single/sidebar' );
    }
    public function sidebar_archive( $sidebarTitle = "آرشیو اخبار" ) {

        view( 'post/archive/sidebar',
            $this->services->sidebar( $sidebarTitle ) );

    }
    public function archive() {
        view( 'post/archive/content',
            array( "items" => $this->services->archive() ) );

    }

}
