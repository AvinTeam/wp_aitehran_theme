<?php
namespace TAI\App\Services\Home;

use TAI\App\Enums\MediaEnums;
use TAI\App\Enums\SectionsEnums;
use TAI\App\Models\GiftCampaign;
use TAI\App\Models\Gifts;
use TAI\App\Models\Media;
use TAI\App\Models\Winners;
use TAI\App\Options\GeneralSetting;
use TAI\App\Services\Service;

( defined( 'ABSPATH' ) ) || exit;

class HomeServices extends Service {

    private $setting  = array();
    private $sections = array();

    public function __construct() {
        $this->setting  = GeneralSetting::get();
        $this->sections = get_option( 'tai_sections', array() );
    }

    public function heroSection() {

        $title = preg_replace( '/##(.+?)##/', '<span class="text-gold-gradient">$1</span>', ( $this->setting[ 'heroTitle' ] ?? '' ) );

        $appLinks = typeLinkArray( ( $this->setting[ 'appLinks' ] ?? array() ) );

        return array(
            'title'       => $title,
            'description' => $this->setting[ 'heroDescription' ] ?? '',
            'download'    => esc_url( ( $appLinks[ 'url' ] ?? '#' ) ),
            'pwa'         => esc_url( ( $appLinks[ 'pwa' ] ?? '#' ) ),
        );
    }

    public function banners() {

        foreach ( get_option( 'tai_banner', array() ) as $value ) {
            $banners[  ] = array(
                'url'  => get_the_image_url_by_id( $value[ 'image' ] ),
                'link' => $value[ 'link' ],
            );
        }

        return array(
            'title'       => SectionsEnums::banners,
            'description' => $this->sections[ 'banners' ] ?? '',
            'banners'     => $banners ?? array(),
        );
    }

    public function statistics() {

        foreach ( get_option( 'tai_statistics', array() ) as $i => $value ) {
            $items[  ] = array(
                'image_url' => get_the_image_url_by_id( $value[ 'image' ] ),
                'title'     => $value[ 'title' ] ?? '',
                'number'    => $value[ 'number' ] ?? 0,
                'link'      => $value[ 'link' ] ?? "",

            );
        }

        return array(
            'list' => $items ?? array(),
        );
    }

    public function works() {

        foreach ( get_option( 'tai_work_list', array() ) as $value ) {
            $works[  ] = array(
                'image'       => get_the_image_url_by_id( $value[ 'image' ] ),
                'title'       => $value[ 'title' ] ?? '',
                'description' => $value[ 'description' ] ?? '',
                'link'        => $value[ 'link' ] ?? '#',
                'shortcode'   => $value[ 'shortcode' ] ?? '',
                'btn_title'   => $value[ 'btn_title' ] ?? '',
            );
        }

        return array(
            'title'       => SectionsEnums::games,
            'description' => $this->sections[ 'games' ] ?? '',
            'works'       => $works ?? array(),
            'clock'       => get_option( 'tai_clock', array() )[ 'setting' ] ?? array(),

        );
    }

    public function gifts() {

        $args = array(
            'taxonomy'   => 'cat_ayeh',
            'hide_empty' => false,
            'meta_query' => array(
                array(
                    'key'   => 'catAyeh_status',
                    'value' => 'active',
                ),
                array(
                    'key'   => 'catAyeh_winnerStatus',
                    'value' => 'active',
                ),
            ),
        );

        $campaigns = get_terms( $args );

        if ( ! empty( $campaigns ) && ! is_wp_error( $campaigns ) ) {
            foreach ( $campaigns as $term ) {
                $git_list_id = GiftCampaign::all()->where( 'campaign_id', $term->term_id );

                 $mytest["id:".$term->term_id] =[$git_list_id->count(),$git_list_id->toArray()];
                if ( $git_list_id->count() > 0 ) {
                    $campaign_list[  ] = array(
                        'id'   => $term->term_id,
                        'name' => $term->name,
                    );
                }

                foreach ( $git_list_id->toArray() as $id ) {
                    $gift = Gifts::find( intval( $id[ 'gift_id' ] ) );

                    if ( $gift ) {
                        $image_id = ( $gift->toArray() )[ 'image_id' ] ?? '';

                        $gift_list[  ] = array(
                            'campaign_id'    => $term->term_id,
                            'campaign_title' => $term->name,
                            'campaign_url'   => get_term_link( $term ),
                            'title'          => ( $gift->toArray() )[ 'title' ] ?? '',
                            'image'          => get_the_image_url_by_id( $image_id ),

                        );
                    }
                }
            }
        }

        return array(
            'title'         => SectionsEnums::gifts,
            'description'   => $this->sections[ 'gifts' ] ?? '',
            'campaign_list' => $campaign_list ?? array(),
            'gift_list'     => $gift_list ?? array(),

        );
    }

    public function winners() {

        $args = array(
            'taxonomy'   => 'cat_ayeh',
            'hide_empty' => false,
            'meta_query' => array(
                array(
                    'key'   => 'catAyeh_winnerStatus',
                    'value' => 'active',
                ),
            ),
        );

        $campaigns = get_terms( $args );

        if ( ! empty( $campaigns ) && ! is_wp_error( $campaigns ) ) {
            foreach ( $campaigns as $term ) {
                $campaign_list[  ] = array(
                    'id'   => $term->term_id,
                    'name' => $term->name,
                );

                $git_list_id = GiftCampaign::all()->where( 'campaign_id', $term->term_id )->toArray();

                foreach ( $git_list_id as $item ) {
                    $winners = Winners::all()
                        ->where( 'campaign_id', $term->term_id )
                        ->where( 'gift_id', $item[ 'gift_id' ] )
                        ->limit( 2 )
                        ->toArray();

                    $gift = Gifts::find( intval( $item[ 'gift_id' ] ) );

                    if ( $gift ) {
                        $giftArray = $gift->toArray();

                        $image_id   = $giftArray[ 'image_id' ] ?? '';
                        $gift_title = $giftArray[ 'title' ] ?? '';
                        $gift_image = get_the_image_url_by_id( $image_id );
                    }

                    foreach ( $winners as $winner ) {
                        $winner_list[  ] = array(
                            'campaign_id'    => $term->term_id,
                            'campaign_title' => $term->name,
                            'campaign_url'   => get_term_link( $term ),
                            'title'          => $gift_title ?? 'نا معلوم',
                            'image'          => $gift_image ?? '',
                            'name'           => $winner[ 'full_name' ],
                            'mobile'         => mobile_mask( $winner[ 'mobile' ] ),

                        );
                    }
                }
            }
        }

        return array(
            'title'         => SectionsEnums::winners,
            'description'   => $this->sections[ 'winners' ] ?? '',
            'campaign_list' => $campaign_list ?? array(),
            'winner_list'   => $winner_list ?? array(),

        );
    }

    public function media() {

        $media_types = array(
            MediaEnums::POSTER     => 'پوستر',
            MediaEnums::TEXT_IMAGE => 'عکس نوشت',
            MediaEnums::SOUND      => 'صوت',
            MediaEnums::VIDEO      => 'ویدئو',
        );

        foreach ( $media_types as $key => $value ) {
            $args = array(
                'taxonomy'   => 'cat_ayeh',
                'hide_empty' => false,
                'meta_query' => array(
                    array(
                        'key'   => 'catAyeh_status',
                        'value' => 'active',
                    ),
                ),
            );

            $terms = get_terms( $args );

            $medias = Media::all()
                ->orderBy( 'created_at', 'DESC' )
                ->whereIn( 'campaign_id', array_column( $terms, 'term_id' ) );

            if ( $terms ) {
                if ( MediaEnums::POSTER == $key ) {
                    $media_list[ $key ][ 'class' ] = ' posterSwiper';

                    $medias = $medias->where( 'ayeh_type', $key )
                        ->where( 'option', '!=', "0" )
                        ->limit( 5 )
                        ->toArray();

                    foreach ( $medias as $media ) {
                        $term = get_term_by( 'id', absint( ( $media[ 'campaign_id' ] ?? 0 ) ), 'cat_ayeh' );

                        if ( $term ) {
                            $array = array(
                                'campaign_link'  => get_term_link( absint( ( $media[ 'campaign_id' ] ) ?? 0 ) ),
                                'campaign_title' => $term ? $term->name : '',
                                'surah'          => $media[ 'surah' ] . " " . $media[ 'verse' ],
                                'surah_link'     => get_permalink( $media[ 'ayeh_id' ] ),
                            );

                            $array[ 'image' ]     = get_the_image_url_by_id( absint( $media[ 'option' ] ) );
                            $array[ 'title' ]     = get_the_title( $media[ 'ayeh_id' ] );
                            $array[ 'home_page' ] = true;

                            $media_list[ $key ][ 'items' ][  ] = $array;
                        }
                    }
                }

                if ( MediaEnums::TEXT_IMAGE == $key ) {
                    $media_list[ $key ][ 'class' ] = ' textImageSwiper';

                    $medias = $medias->where( 'ayeh_type', $key )
                        ->limit( 4 )
                        ->toArray();

                    foreach ( $medias as $media ) {
                        $term = get_term_by( 'id', absint( ( $media[ 'campaign_id' ] ?? 0 ) ), 'cat_ayeh' );

                        if ( $term ) {
                            $array = array(
                                'campaign_link'  => get_term_link( absint( ( $media[ 'campaign_id' ] ) ?? 0 ) ),
                                'campaign_title' => $term ? $term->name : '',
                                'surah'          => $media[ 'surah' ] . " " . $media[ 'verse' ],
                                'surah_link'     => get_permalink( $media[ 'ayeh_id' ] ),
                            );

                            $option = (
                                is_string( $media[ 'option' ] ) &&
                                strlen( $media[ 'option' ] ) > 16 )
                                ? unserialize( $media[ 'option' ] )
                                : array();

                            $array[ 'image' ]                  = get_the_image_url_by_id( absint( $option[ 'image' ] ?? 0 ) );
                            $array[ 'description' ]            = sanitize_text_field( $option[ 'description' ] ?? '' );
                            $media_list[ $key ][ 'items' ][  ] = $array;
                        }
                    }
                }

                if ( MediaEnums::SOUND == $key ) {
                    $media_list[ $key ][ 'class' ] = ' soundSwiper';

                    $medias = $medias->where( 'ayeh_type', $key )
                        ->limit( 3 )
                        ->toArray();

                    foreach ( $medias as $media ) {
                        $term = get_term_by( 'id', absint( ( $media[ 'campaign_id' ] ?? 0 ) ), 'cat_ayeh' );

                        if ( $term ) {
                            $array = array(
                                'campaign_link'  => get_term_link( absint( ( $media[ 'campaign_id' ] ) ?? 0 ) ),
                                'campaign_title' => $term ? $term->name : '',
                                'surah'          => $media[ 'surah' ] . " " . $media[ 'verse' ],
                                'surah_link'     => get_permalink( $media[ 'ayeh_id' ] ),
                            );

                            $option = unserialize( $media[ 'option' ] );

                            $array[ 'image' ]                  = get_the_image_url_by_id( absint( $option[ 'image' ] ) );
                            $array[ 'title' ]                  = $option[ 'title' ] ?? '';
                            $array[ 'link' ]                   = $option[ 'link' ] ?? '';
                            $array[ 'description' ]            = $option[ 'description' ] ?? '';
                            $media_list[ $key ][ 'items' ][  ] = $array;
                        }
                    }
                }

                if ( MediaEnums::VIDEO == $key ) {
                    $media_list[ $key ][ 'class' ] = ' videoSwiper';

                    $medias = $medias->where( 'ayeh_type', $key )
                        ->limit( 3 )
                        ->toArray();

                    foreach ( $medias as $media ) {
                        $term = get_term_by( 'id', absint( ( $media[ 'campaign_id' ] ?? 0 ) ), 'cat_ayeh' );

                        if ( $term ) {
                            $array = array(
                                'campaign_link'  => get_term_link( absint( ( $media[ 'campaign_id' ] ) ?? 0 ) ),
                                'campaign_title' => $term ? $term->name : '',
                                'surah'          => $media[ 'surah' ] . " " . $media[ 'verse' ],
                                'surah_link'     => get_permalink( $media[ 'ayeh_id' ] ),
                            );

                            $option = unserialize( $media[ 'option' ] );

                            $array[ 'image' ]                  = get_the_image_url_by_id( absint( $option[ 'image' ] ) );
                            $array[ 'title' ]                  = $option[ 'title' ] ?? '';
                            $array[ 'link' ]                   = $option[ 'link' ] ?? '';
                            $array[ 'description' ]            = $option[ 'description' ] ?? '';
                            $media_list[ $key ][ 'items' ][  ] = $array;
                        }
                    }
                }
            }
        }

        return array(
            'title'       => SectionsEnums::media,
            'description' => $this->sections[ 'media' ] ?? '',
            'media_types' => $media_types ?? array(),
            'media_list'  => $media_list ?? array(),

        );
    }

    public function news() {

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'fields'         => 'ids',
        );

        foreach ( get_posts( $args ) as $id ) {
            $news[  ] = array(
                'title'   => get_the_title( $id ),
                'image'   => post_image_url( $id ),
                'side'    => get_post_meta( $id, '_comment_side', true ),
                'content' => get_the_excerpt( $id ),
                'link'    => get_permalink( $id ),

            );
        }

        return array(
            'title'       => SectionsEnums::news,
            'description' => $this->sections[ 'news' ] ?? '',
            'news'        => $news ?? array(),
        );
    }

    public function faq() {

        return array(
            'title'       => SectionsEnums::faq,
            'description' => $this->sections[ 'faq' ] ?? '',
            'faqs'        => get_option( 'tai_faq', array() ),
            'phone'       => sanitize_phone( ( $this->setting[ 'phone' ] ?? '' ) ),
        );
    }

    public function poster() {

        $appLinks = typeLinkArray( ( $this->setting[ 'appLinks' ] ?? array() ) );

        return array(
            'title'       => SectionsEnums::poster,
            'description' => $this->sections[ 'poster' ] ?? '',
            'download'    => esc_url( ( $appLinks[ 'url' ] ?? '#' ) ),
            'pwa'         => esc_url( ( $appLinks[ 'pwa' ] ?? '#' ) ),
        );
    }

    public function supporters() {

        $images = array_map( function ( $id ) {

            return wp_get_attachment_url( $id );
        }, explode( ',', get_option( "supporters-gallery", '' ) ) );

        return array(
            'title'       => SectionsEnums::supported,
            'description' => $this->sections[ 'supported' ] ?? '',
            'images'      => $images ?? array(),

        );
    }
}
