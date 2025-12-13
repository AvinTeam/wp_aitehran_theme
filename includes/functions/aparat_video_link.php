<?php
(defined('ABSPATH')) || exit;

if (! function_exists('aparat_video_link')) {
    function aparat_video_link($link)
    {

        if (strpos($link, 'aparat.com') !== false) {
            if (preg_match('/aparat\.com\/v\/([a-zA-Z0-9]+)/', $link, $matches)) {
                $link = $matches[ 1 ];
            }

            $aparat = get_remote('https://www.aparat.com/etc/api/video/videohash/' . $link);

            $link = '';

            if ($aparat->success) {

                $aparat = $aparat->result;
                if (isset($aparat->video)) {

                    $link = $aparat->video->file_link;
                }
            }
        }

        return $link;
    }
}