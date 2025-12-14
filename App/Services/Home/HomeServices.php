<?php
namespace TAI\App\Services\Home;

use TAI\App\Options\GeneralSetting;
use TAI\App\Services\Service;
use WP_Query;

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

        return array(
            'title'       => $title,
            'description' => $this->setting[ 'heroDescription' ] ?? '',

        );
    }

    public function format() {

        $formats = array_map( "basename", glob( TAI_PATH . 'assets/image/formats/*' ) );

        return array(

            "formats" => $formats,

        );
    }

    public function news( $category ) {

         $args = array(
            'post_type'     => 'post',
            'category_name' => $category,
            'posts_per_page' => -1, 
                'post_status'    => 'publish',


        );

        
        $query = new WP_Query( $args );

        if ( $query->have_posts() ):

            while ( $query->have_posts() ): $query->the_post();
                $allPost[  ] = array(
                    "title" => get_the_title(),
                    "image" => post_image_url(),
                    "link"  => get_permalink(),
                    "date"  => get_the_date(),
                );
            endwhile;

            wp_reset_postdata();
        endif;

        return $allPost ?? array();
    }

}
