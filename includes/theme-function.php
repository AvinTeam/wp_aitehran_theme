<?php

(defined('ABSPATH')) || exit;

function tarikh($data, $type = '')
{

    $data_array = explode(" ", $data);

    $data = $data_array[ 0 ];
    $time = (sizeof($data_array) >= 2) ? $data_array[ 1 ] : 0;

    $has_mode = (strpos($data, '-')) ? '-' : '/';

    list($y, $m, $d) = explode($has_mode, $data);

    $ch_date = (strpos($data, '-')) ? gregorian_to_jalali($y, $m, $d, '/') : jalali_to_gregorian($y, $m, $d, '-');

    if ($type == 'time') {
        $new_date = $time;
    } elseif ($type == 'date') {
        $new_date = $ch_date;
    } else {
        $new_date = ($time === 0) ? $ch_date : $ch_date . ' ' . $time;
    }

    return $new_date;

}

function get_current_relative_url()
{
    // گرفتن مسیر فعلی بدون دامنه
    $path = esc_url_raw(wp_unslash($_SERVER[ 'REQUEST_URI' ]));

                                                // حذف دامنه و فقط نگه داشتن مسیر نسبی + پارامترها
    $relative_url = strtok($path, '?');         // مسیر قبل از پارامترها
    $query_string = $_SERVER[ 'QUERY_STRING' ]; // پارامترهای GET

    // اگر پارامتر وجود داره، به مسیر اضافه کن
    if ($query_string) {
        $relative_url .= '?' . $query_string;
    }

    return $relative_url;
}

function tai_to_english($text)
{

    $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
    $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
    $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
    $text    = str_replace($persian, $western, $text);
    $text    = str_replace($arabic, $western, $text);
    return $text;

}

function is_mobile($mobile)
{
    $pattern = '/^(\+98|0)?9\d{9}$/';
    return preg_match($pattern, $mobile);
}



function linktocode($input)
{
    if (preg_match('/^[a-zA-Z0-9]+$/', $input)) {
        return $input; // ورودی همان کد است
    }

    if (preg_match('/aparat\.com\/v\/([a-zA-Z0-9]+)/', $input, $matches)) {
        return $matches[ 1 ]; // کد ویدیو را برگردان
    }

    return null;
}

function mr_time_start_working()
{
    $clock_mr_setting = get_option('mr_setting_clock');

    if (! isset($clock_mr_setting[ 'version' ]) || version_compare(TAI_VERSION, $clock_mr_setting[ 'version' ], '>')) {

        update_option(
            'mr_setting_clock',
            [
                'version'    => TAI_VERSION,

                'setting'    => (isset($clock_mr_setting[ 'setting' ])) ? absint($clock_mr_setting[ 'setting' ]) : 0,
                'setting_tv' => (isset($clock_mr_setting[ 'setting_tv' ])) ? absint($clock_mr_setting[ 'setting_tv' ]) : 0,
                'clock_decs' => (isset($clock_mr_setting[ 'clock_decs' ])) ? sanitize_text_field($clock_mr_setting[ 'clock_decs' ]) : '',
                'timestamp'  => (isset($clock_mr_setting[ 'timestamp' ])) ? absint($clock_mr_setting[ 'timestamp' ]) : 5,

             ]

        );

    }

    return get_option('mr_setting_clock');

}

function time_update_option($data)
{

    $clock_mr_setting = get_option('mr_setting_clock');

    $clock_mr_setting = [
        'version'    => TAI_VERSION,

        'setting'    => (isset($data[ 'setting' ])) ? absint($data[ 'setting' ]) : $clock_mr_setting[ 'setting' ],
        'setting_tv' => (isset($data[ 'setting_tv' ])) ? absint($data[ 'setting_tv' ]) : $clock_mr_setting[ 'setting_tv' ],
        'clock_decs' => (isset($data[ 'clock_decs' ])) ? sanitize_text_field($data[ 'clock_decs' ]) : $clock_mr_setting[ 'clock_decs' ],
        'timestamp'  => (isset($data[ 'timestamp' ])) ? absint($data[ 'timestamp' ]) : $clock_mr_setting[ 'timestamp' ],

     ];

    update_option('mr_setting_clock', $clock_mr_setting);

}
