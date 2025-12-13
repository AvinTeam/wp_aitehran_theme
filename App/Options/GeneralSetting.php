<?php
namespace TAI\App\Options;

use TAI\App\Core\Options;

(defined('ABSPATH')) || exit;

class GeneralSetting extends Options
{

    public static function get()
    {
        return self::getter();
    }

    public static function set(array $input)
    {

        if (! isset($input[ 'socials' ])) {
            $input[ 'socials' ] = [  ];
        }

        return self::setter($input);
    }
}