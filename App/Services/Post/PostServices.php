<?php
namespace TAI\App\Services\Post;

use TAI\App\Enums\SectionsEnums;
use TAI\App\Services\Service;

(defined('ABSPATH')) || exit;

class PostServices extends Service
{

    private $sections = [  ];

    public function __construct()
    {
        $this->sections = get_option('tai_sections', [  ]);
    }

    public function header()
    {
        return [
            'title'       => get_the_title(),
            'description' => get_the_excerpt(),
         ];
    }

    public function hero()
    {
        return [

            'title'       => get_the_title(),
            'description' => get_the_excerpt(),
            'image'       => post_image_url(),
            'side'        => get_post_meta(get_the_ID(), '_comment_side', true),

         ];
    }

    public function list()
    {

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'fields'         => 'ids',
            'post__not_in'   => [ get_the_ID() ],
            'orderby'        => 'rand',
         ];

        foreach (get_posts($args) as $id) {

            $news[  ] = [
                'title'   => get_the_title($id),
                'image'   => post_image_url($id),
                'side'    => get_post_meta($id, '_comment_side', true),
                'content' => get_the_excerpt($id),
                'link'    => get_permalink($id),

             ];

        }
        return [
            'title'       => SectionsEnums::news,
            'description' => $this->sections[ 'news' ] ?? '',
            'newsList'    => $news ?? [  ],
         ];
    }

}
