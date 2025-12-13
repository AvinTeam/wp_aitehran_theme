<?php
namespace TAI\App\Services\Blog;

use WP_Query;
use TAI\App\Core\Traits\JDF;
use TAI\App\Enums\SectionsEnums;
use TAI\App\Services\Service;

(defined('ABSPATH')) || exit;

class BlogServices extends Service
{
    use JDF;
    private $sections        = [  ];
    private int $total_items = 0;
    private int $paged       = 1;
    private int $par_page    = 12;

    public function __construct(array $result)
    {

        $this->paged = (isset($result[ 'page' ]) && absint($result[ 'page' ]) >= 1) ? absint($result[ 'page' ]) : 1;

        $this->sections = get_option('tai_sections', [  ]);

    }

    public function header()
    {
        return [
            'title'       => SectionsEnums::news,
            'description' => $this->sections[ 'news' ] ?? '',
         ];
    }

    public function results()
    {

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $this->par_page,
            'paged'          => $this->paged,
            'fields'         => 'ids',
         ];

        $query = new WP_Query($args);

        $total_posts       = $query->found_posts;
        $this->total_items = $total_posts;

        if ($query->have_posts()) {

            while ($query->have_posts()) {
                $query->the_post();

                $id       = get_the_ID();
                $news[  ] = [
                    'title'   => get_the_title($id),
                    'image'   => post_image_url($id),
                    'side'    => get_post_meta($id, '_comment_side', true),
                    'content' => get_the_excerpt($id),
                    'link'    => get_permalink($id),
                 ];

            }
        }

        wp_reset_postdata();
        return [
            'newsList' => $news ?? [  ],
         ];
    }

    public function pagination()
    {

        $url = home_url(config('urls.blog') . '/');

        // dd(
        //     $url,
        //     $this->par_page,
        //     $this->total_items,
        //     $this->paged
        // );

        generatePagination($url, $this->par_page, $this->total_items, $this->paged);

    }

}
