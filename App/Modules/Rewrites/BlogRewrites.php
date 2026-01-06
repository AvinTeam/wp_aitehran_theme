<?php
namespace TAI\App\Modules\Rewrites;

use TAI\App\Core\Rewrites;

( defined( 'ABSPATH' ) ) || exit;

class BlogRewrites extends Rewrites {

    private $key = "blog";

    public function __construct() {

        add_action( 'init', array( $this, 'add_rewrite' ) );
        add_filter( 'query_vars', array( $this, 'query_vars' ) );
        add_filter( 'template_include', array( $this, 'template_include' ) );
    }

    public function add_rewrite() {
        add_rewrite_rule(
            $this->key . '/?',
            'index.php?' . $this->key . '=dashboard',
            'top'
        );
    }

    public function query_vars( $public_query_vars ) {
        $public_query_vars[  ] = $this->key;

        return $public_query_vars;
    }

    public function template_include( $template ) {

        $tai = get_query_var( $this->key );

        if ( $tai ) {
            $path = $this->path( $tai );

            if ( $path ) {return $path;}
        }

        return $template;
    }

    public function path( $panel = false ) {

        if ( ! $panel ) {return;}
        add_filter( 'wp_title', function ( $title ) {

            return "آرشیو اخبار | " . get_bloginfo( 'name' );
        }, 11 );

        return TAI_PATH . 'blog.php';
    }
}
