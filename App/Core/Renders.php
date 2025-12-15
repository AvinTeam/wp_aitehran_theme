<?php
namespace TAI\App\Core;

use Exception;

( defined( 'ABSPATH' ) ) || exit;

class Renders {

    public function __construct() {

        $this->render( "Menus" );
        $this->render( "Rewrites" );
        $this->render( "PostTypes" );
        $this->render( "Taxonomies" );
        $this->render( "MetaBoxes" );
        $this->render( "AJAX" );
    }

    public function render( $moduleName ) {
        $path = TAI_PATH . 'App/Modules/' . $moduleName . '/';

        if ( ! is_dir( $path ) ) {
            throw new Exception( "PostTypes directory not found: " . $path );
        }

        $files = glob( $path . '*.php' );

        if ( empty( $files ) ) {
            throw new Exception( "No PostTypes files found in: " . $path );
        }

        foreach ( $files as $file ) {
            try {
                $fileName      = pathinfo( $file, PATHINFO_FILENAME );
                $fullClassName = 'TAI\\App\\Modules\\' . $moduleName . '\\' . $fileName;

                if ( ! class_exists( $fullClassName ) ) {
                    throw new Exception( "Class {$fullClassName} not found" );
                }

                new $fullClassName();
            } catch ( Exception $e ) {
                continue;
            }
        }
    }
}
