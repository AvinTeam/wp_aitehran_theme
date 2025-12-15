<?php
namespace TAI\App\Controllers\post;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Post\PostServices;

( defined( 'ABSPATH' ) ) || exit;

class PostController extends Controller {

    protected $services;

    public function __construct() {
        $this->services = new PostServices();
    }

    public function content() {
        view( 'post/single/content' );
    }


    public function sidebar() {
        view( 'post/single/sidebar', 
        $this->services->sidebar() );

    }
}