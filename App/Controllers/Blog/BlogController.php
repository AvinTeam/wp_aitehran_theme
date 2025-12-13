<?php
namespace TAI\App\Controllers\Blog;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Blog\BlogServices;

(defined('ABSPATH')) || exit;

class BlogController extends Controller
{

    protected $services;

    public function __construct(array $result)
    {

        $this->services = new BlogServices($result);

    }

    public function header()
    {
        view('post/archive/header',
            $this->services->header()
        );

    }

    public function results()
    {
        view('post/archive/results',
            $this->services->results()
        );

    }

    public function pagination()
    {
        $this->services->pagination();

    }

}
