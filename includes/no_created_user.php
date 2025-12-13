<?php

use taiclass\TAIDB;

(defined('ABSPATH')) || exit;



add_action('no_created_user', 'fun_no_created_user');

function fun_no_created_user($mobile)
{
    $massage = '';

    $taidb = new TAIDB('winners');

    $arg = [
        'data' => [
            'mobile' => $mobile,

         ],

     ];

    $all_win = $taidb->select($arg);

    if ($all_win) {

        $gift = "";
        foreach ($all_win as $key => $win) {
            if ($key) {$gift .= '، ';}
            $gift .= $win->gift;
        }

        $massage .= '<div class="alert alert-success" role="alert">';
        $massage .= '<p><h2 class="text-center text-bold">تبریک شما برنده شده اید.</h2></p>';
        $massage .= '<p ><b>جایزه:</b> ' . $gift.'</p>';
        $massage .= '<p ><b>وضعیت:</b> در حال پردازش و اقدام</p>';
        $massage .= '</div>';

    } else {
        $massage .= '<div class="alert alert-danger" role="alert">شما تاکنون در قرعه کشی پویش زندگی با آیه ها برنده جایزه نشده اید. امیدواریم در پویش های بعدی شما نیز برنده شوید.</div>';
    }

    set_transient('tai_transient', $massage, 10 * MINUTE_IN_SECONDS);

}