<?php

(defined('ABSPATH')) || exit;

function sanitize_no_item($item)
{
    foreach ($item as $key => $value) {
        if (is_array($value) || is_object($value)) {
            $notEmptyItem = 0;
            foreach (array_values($value) as $valueItem) {
                if (!empty(trim($valueItem))) {
                    $notEmptyItem++;
                }
            }

            if ($notEmptyItem == 0) {
                continue;
            }
            
            $value = array_map('wp_unslash', $value);
            $value = array_map('sanitize_textarea_field', $value);

        } else {
            if (empty(trim($value))) {
                continue;
            }
            $value = sanitize_textarea_field(wp_unslash($value));
        }

        $newItem[$key] = $value;
    }
    return $newItem ?? [];
}