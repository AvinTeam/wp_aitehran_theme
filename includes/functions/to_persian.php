<?php
(defined('ABSPATH')) || exit;

if (! function_exists('to_persian')) {
    function to_persian($text)
    {

        $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
        $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
        $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
        $text    = str_replace($western, $persian, $text);
        $text    = str_replace($arabic, $persian, $text);
        return $text;

    }
}
