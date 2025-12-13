<?php

if (! function_exists('sanitize_phone')) {
    function sanitize_phone($phone)
    {

        $phone = trim($phone);

        $phone = str_replace('-', '', $phone);

        $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
        $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
        $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];

        $phone = str_replace($persian, $western, $phone);
        $phone = str_replace($arabic, $western, $phone);



        return substr($phone, 0, 11);

    }
}
