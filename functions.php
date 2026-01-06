<?php

use TAI\App\Core\Accesses;
use TAI\App\Core\FunctionAutoloader;
use TAI\App\Core\Init;
use TAI\App\Core\Install;
use TAI\App\Core\Renders;
use TAI\App\Core\SendSMS;
use TAI\App\Core\Styles;
use TAI\App\EditColumn\UserEditColumn;
use TAI\App\EditForms\CategoryTaxonomyEditForms;
use TAI\App\EditForms\UserEditForms;

( defined( 'ABSPATH' ) ) || exit;

// header( 'Content-Type: text/html; charset=utf-8' );
date_default_timezone_set( 'Asia/Tehran' );

define( 'TAI_VERSION', '0.0.37' );

define( 'TAI_PATH', get_template_directory() . "/" );
define( 'TAI_INCLUDES', TAI_PATH . 'includes/' );
define( 'TAI_CLASS', TAI_PATH . 'classes/' );
define( 'TAI_CORE', TAI_PATH . 'core/' );
define( 'TAI_CONFIG', TAI_PATH . 'config/' );
define( 'TAI_VIEWS', TAI_PATH . 'views/' );
define( 'TAI_CAPTCHA', TAI_PATH . 'upload/captcha/' );

define( 'TAI_URL', get_template_directory_uri() . "/" );
define( 'TAI_CAPTCHA_URL', TAI_URL . 'upload/captcha/' );
define( 'TAI_ASSETS', TAI_URL . 'assets/' );
define( 'TAI_CSS', TAI_ASSETS . 'css/' );
define( 'TAI_JS', TAI_ASSETS . 'js/' );
define( 'TAI_IMAGE', TAI_ASSETS . 'image/' );
define( 'TAI_VIDEO', TAI_ASSETS . 'video/' );
define( 'TAI_VENDOR', TAI_ASSETS . 'vendor/' );

define( 'TAI_SMS_TIMER', 1 );
define( 'TAI_TIME_SET_COOKIE', 30 );
define( 'TAI_CAPTCHA_LEN', 5 );
define( 'TAI_OTP_COUNT', 4 );
define( 'TAI_local', "localhost:85" == $_SERVER[ 'HTTP_HOST' ] ? true : false );

if ( file_exists( TAI_PATH . '/vendor/autoload.php' ) ) {
    require_once TAI_PATH . '/vendor/autoload.php';
}

// flush_rewrite_rules();

// require_once TAI_INCLUDES . '/started.php';
new FunctionAutoloader();

new Accesses();
new Init();
new Styles();
new Renders();
new UserEditColumn();
new UserEditForms();
new CategoryTaxonomyEditForms();

// new TVRemotes;

if ( is_admin() ) {
    new Install();
}

if ( isset( $_GET[ "test" ] ) ) {

    dd(SendSMS::otp( sanitize_phone( "09113078966") ));
    exit;
}
