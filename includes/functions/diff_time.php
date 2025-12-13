<?php

(defined('ABSPATH')) || exit;

function diff_time($time)
{

    $date1 = date_create(date("Y-m-d H:i:s", $time));
    $date2 = date_create(date("Y-m-d H:i:s", time()));

    if ($date1 < $date2) {
        return 'مسابقه در حال انحام است';
    }
    $result = date_diff($date1, $date2);

    $time = '';
    if ($result->y) {
        $time .= ($result->y < 10 ? '0' . $result->y : $result->y) . ':';
    }

    if ($result->m) {
        $time .= ($result->m < 10 ? '0' . $result->m : $result->m) . ':';
    }

    if ($result->d) {
        $time .= ($result->d < 10 ? '0' . $result->d : $result->d) . ':';
    }

    if ($result->h) {
        $time .= ($result->h < 10 ? '0' . $result->h : $result->h) . ':';
    }

    if ($result->i) {
        $time .= ($result->i < 10 ? '0' . $result->i : $result->i) . ':';
    }

    if ($result->s) {
        $time .= ($result->s < 10 ? '0' . $result->s : $result->s);
    }

    return $time;

}
