<?php
(defined('ABSPATH')) || exit;

function view($view, $response = null)
{
    $file = TAI_VIEWS . $view . '.php';
    
    if (! file_exists($file)) {

        echo "<p style='text-align:center'>dont have view -> $view</p>";
    } else {

        if ($response != null && (is_array($response) || is_object($response))) {

            extract($response);

        }

        require $file;
    }

}
