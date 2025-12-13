<?php
(defined('ABSPATH')) || exit;

function components($view, $response = null)
{

    $file = TAI_VIEWS . 'components/' . $view . '.php';

    if (! file_exists($file)) {

        echo "<p style='text-align:center'>dont have components -> $view</p>";

    } else {

        if ($response != null && (is_array($response) || is_object($response))) {
            extract($response);
        }

        require $file;
    }

}