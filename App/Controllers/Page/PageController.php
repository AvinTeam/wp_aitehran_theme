<?php
namespace TAI\App\Controllers\Page;

use TAI\App\Controllers\Controller;
use TAI\App\Services\Page\PageServices;

(defined('ABSPATH')) || exit;

class PageController extends Controller
{

    protected $services;

    public function __construct()
    {
        $this->services = new PageServices;
    }

    public function header()
    {
        view('page/header',
            $this->services->header()
        );
    }

    public function content()
    {
        view('page/content',
            $this->services->content()
        );
    }

}
