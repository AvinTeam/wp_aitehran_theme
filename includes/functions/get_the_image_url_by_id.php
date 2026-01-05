<?php
(defined('ABSPATH')) || exit;

function get_the_image_url_by_id($id, $default = null)
{

    return absint($id) ? wp_get_attachment_url(absint($id)) : ($default ?? "");
}