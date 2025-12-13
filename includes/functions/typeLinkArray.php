<?php
(defined('ABSPATH')) || exit;

if (! function_exists('typeLinkArray')) {
    function typeLinkArray($inputArray)
    {

        foreach ($inputArray as $item) {
            if (is_array($item) && isset($item[ 'type' ]) && isset($item[ 'link' ])) {
                $result[ $item[ 'type' ] ] = $item[ 'link' ];
            }
        }

        return $result ?? [  ];
    }
}