<?php
(defined('ABSPATH')) || exit;

function get_the_image_url($path)
{
    return TAI_IMAGE . $path . '?ver=' . TAI_VERSION;
}
