<?php
(defined('ABSPATH')) || exit;

function get_remote(string $url)
{
    $res = wp_remote_get(
        $url,
        [
            'timeout' => 1000,
         ]);

    if (is_wp_error($res)) {

        $result = (object) [
            'success' => false,
            'result'  => $res->get_error_message(),
         ];
    } else {
        $result = (object) [
            'success' => true,
            'result'  => json_decode($res[ 'body' ]),
         ];
    }

    return $result;
}
