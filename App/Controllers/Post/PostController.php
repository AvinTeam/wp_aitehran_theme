<?php
namespace TAI\App\Controllers\post;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Post\PostServices;

(defined('ABSPATH')) || exit;

class PostController extends Controller
{

    protected $services;

    public function __construct()
    {
        $this->services = new PostServices;
    }

    public function header()
    {
        view('post/single/header',
            $this->services->header()
        );
    }

    public function hero()
    {
        view('post/single/hero',
            $this->services->hero()
        );
    }

    public function content()
    {
        view('post/single/content');
    }
    
    public function list()
    {
            view('post/single/list',
            $this->services->list()
        );
    }
}
