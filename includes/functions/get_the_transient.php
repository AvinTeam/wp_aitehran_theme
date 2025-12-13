<?php

function get_the_transient()
{
    $tai_transient = get_transient('general_transient');

    if ($tai_transient) {
        delete_transient('general_transient');
        return $tai_transient;
    }

}
