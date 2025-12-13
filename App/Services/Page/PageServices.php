<?php
namespace TAI\App\Services\Page;

use TAI\App\Enums\MediaEnums;
use TAI\App\Models\Media;
use TAI\App\Services\Service;

(defined('ABSPATH')) || exit;

class PageServices extends Service
{

    private int $post_id = 0;

    public function __construct()
    {
        $this->post_id = get_the_ID();

    }

    public function header()
    {

        return [
            'title' => get_the_title(),
         ];

    }

    public function content()
    {
        return [
            'content' => '',
         ];
    }


}
