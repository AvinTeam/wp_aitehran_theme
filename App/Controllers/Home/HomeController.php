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

    public function banners()
    {
        view('home/banners',
            $this->services->banners()
        );

    }
    
    public function statistics()
    {
        view('home/statistics',
            $this->services->statistics()
        );

    }

    public function works()
    {
        view('home/works',
            $this->services->works()
        );

    }

    public function gifts()
    {
        view('home/gifts',
            $this->services->gifts()
        );
    }

    public function winners()
    {
        view('home/winners',
            $this->services->winners()
        );
    }

    public function media()
    {
        view('home/media',
            $this->services->media()
        );

    }

    public function news()
    {
        view('home/news',
            $this->services->news()
        );
    }

    public function faq()
    {
        view('home/faq',
            $this->services->faq()
        );

    }

    public function poster()
    {
        view('home/poster',
            $this->services->poster()
        );

    }

    public function supporters()
    {
        view('home/supporters',
            $this->services->supporters()
        );

    }

}