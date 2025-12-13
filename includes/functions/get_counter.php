<?php
(defined('ABSPATH')) || exit;

if (! function_exists('get_counter ')) {
    function get_counter($text)
    {

        $result = preg_replace_callback(
            '/([+])?(\d+)/',
            function ($matches) {
                $sign   = $matches[ 1 ] ?? '';
                $number = $matches[ 2 ];
                return $sign . '<span class="counter-number" data-target="' . $number . '">' . $number . '</span>';
            },
            to_english($text)
        );

        return $result ?? '';
    }
}
