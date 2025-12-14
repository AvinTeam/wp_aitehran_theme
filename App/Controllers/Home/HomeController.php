<?php
namespace TAI\App\Controllers\Home;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Home\HomeServices;

(defined('ABSPATH')) || exit;

class HomeController extends Controller
{

    protected $services;

    public function __construct()
    {

        $this->services = new HomeServices;

    }

    public function heroSection()
    {
        view('home/heroSection',
            $this->services->heroSection()
        );

    }
    public function format()
    {
        view('home/format',
            $this->services->format());

    }


}