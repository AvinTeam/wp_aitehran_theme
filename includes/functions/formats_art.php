<?php
( defined( 'ABSPATH' ) ) || exit;

function formats_art( $id = null ) {

    if ( ! is_null( $id ) && absint( $id ) == 0 ) {
        return "نا مشخص";
    }

    $array = array(

        "1" => "بازی",
        "2" => "برنامه‌‌نویسی",
        "3" => "صوت",
        "4" => "فیلم و ویدئو",
        "5" => "گرافیک",
        "6" => "مکتوب",
    );

    return $id ? $array[ $id ] : $array;
}
