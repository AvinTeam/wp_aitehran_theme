<?php
namespace TAI\App\Services\Search;

use Exception;
use WP_Query;
use TAI\App\Core\Traits\JDF;
use TAI\App\Enums\MediaEnums;
use TAI\App\Models\Media;
use TAI\App\Services\Service;

(defined('ABSPATH')) || exit;

class SearchServices extends Service
{
    use JDF;

    private array $types     = [ 'news', 'ayeh', MediaEnums::VIDEO, MediaEnums::SOUND ];
    private int $total_items = 0;
    private int $par_page    = 30;
    private int $paged       = 1;

    private $result = [  ];

    public function __construct(array $result)
    {

        if (! isset($result[ 'type' ]) || ! in_array($result[ 'type' ], $this->types)) {

            throw new Exception("پویش یافت نشد", 404);
        }

        $this->result = $result;

        $this->paged = (isset($this->result[ 'page' ]) && absint($this->result[ 'page' ]) >= 1) ? absint($this->result[ 'page' ]) : 1;

    }

    public function header()
    {
        return [
            'title' => "نتایج جستجو برای: " . get_search_query(),
         ];
    }

    public function results()
    {
        $result = $this->result;
        if ($result[ 'type' ] == 'news') {
            $this->news();
        } elseif ($result[ 'type' ] == 'ayeh') {
            $this->ayeh();
        } elseif (in_array($result[ 'type' ], [ MediaEnums::VIDEO, MediaEnums::SOUND ])) {
            $this->media($result[ 'type' ]);
        }

    }

    public function pagination()
    {
        $url = home_url('?s=' . get_search_query() . '&type=news');

        generatePagination($url, $this->par_page, $this->total_items, $this->paged);

    }

    public function news()
    {

        $this->par_page = 15;

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $this->par_page,
            'paged'          => $this->paged,
            'fields'         => 'ids',
            's'              => get_search_query(),
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

        view('search/news',
            [
                'newsList' => $news ?? [  ],
             ]);

    }

    public function ayeh()
    {

        $this->par_page = 15;

        $args = [
            'post_type'      => 'content_ayeh',
            'posts_per_page' => $this->par_page,
            'paged'          => $this->paged,
            'fields'         => 'ids',
            's'              => get_search_query(),
         ];

        $query = new WP_Query($args);

        $total_posts       = $query->found_posts;
        $this->total_items = $total_posts;

        if ($query->have_posts()) {

            while ($query->have_posts()) {
                $query->the_post();

                $id = get_the_ID();

                $surah = get_post_meta($id, '_ayeh_surah', true);
                $verse = get_post_meta($id, '_ayeh_verse', true);

                $list[  ] = [
                    'title'    => get_the_title($id),
                    'ayeh'     => get_post_meta($id, '_ayeh_ayeh', true),
                    'tarjomeh' => get_post_meta($id, '_ayeh_tarjomeh', true),
                    'surah'    => "سوره $surah آیه $verse",
                    'link'     => get_the_permalink($id),
                 ];

            }
        }

        wp_reset_postdata();

        view('ayeh/taxonomy/List', [
            'list' => $list ?? [  ],
         ]);

    }

    public function media($type)
    {

        $this->par_page = 15;

        $like = "%" . sanitize_text_field(get_search_query()) . "%";

        $medias =
        Media::all()
            ->orWhere('surah', 'LIKE', $like)
            ->orWhere('option', 'LIKE', $like)
            ->toArray();

        foreach ($medias as $media) {

            if ($media[ 'ayeh_type' ] != $type) {continue;}

            $term = get_term_by('id', absint(($media[ 'campaign_id' ] ?? 0)), 'cat_ayeh');

            $array = [
                'campaign_link'  => get_term_link(absint(($media[ 'campaign_id' ]) ?? 0)),
                'campaign_title' => $term ? $term->name : '',
                'surah'          => $media[ 'surah' ] . " " . $media[ 'verse' ],
                'surah_link'     => get_permalink($media[ 'ayeh_id' ]),
             ];

            $option = unserialize($media[ 'option' ]);

            $array[ 'image' ] = get_the_image_url_by_id(absint($option[ 'image' ]));
            $array[ 'title' ] = $option[ 'title' ] ?? '';
            $array[ 'link' ]  = $option[ 'link' ] ?? '';

            $media_list[  ] = $array;

        }

        view('search/media', [
            'mediaType'  => $type,
            'media_list' => $media_list ?? [  ],
         ]);

    }

}
