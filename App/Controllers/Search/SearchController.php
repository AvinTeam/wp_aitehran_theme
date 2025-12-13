<?php
namespace TAI\App\Controllers\Search;

use Exception;
use TAI\App\Controllers\Controller;
use TAI\App\Services\Search\SearchServices;

(defined('ABSPATH')) || exit;

class SearchController extends Controller
{

    protected $services;

    public function __construct(array $result)
    {

        try {

            $this->services = new SearchServices($result);

        } catch (Exception $e) {

            if ($e->getCode() == 404) {
                wp_redirect(home_url('404'));
                exit;

            }

        }

    }

    public function header()
    {

        view('search/header',
            $this->services->header()
        );
    }

    public function results()
    {
        $this->services->results();
    }

    public function pagination()
    {
        $this->services->pagination();

    }

}
