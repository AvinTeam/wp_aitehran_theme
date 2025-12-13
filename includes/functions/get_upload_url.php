<?php
(defined('ABSPATH')) || exit;

function get_upload_url($path)
{
    return TAI_UPLOAD . $path . '?ver=' . TAI_VERSION;
}
