<?php
(defined('ABSPATH')) || exit;

function mobile_mask($mobile)
{

    $mobile = (string) $mobile;
    // بررسی طول شماره موبایل
    if (strlen($mobile) === 11) {
        $masked = substr($mobile, -3) . '****' . substr($mobile, 0, 4);
        return $masked;
    }
    return "شماره موبایل نامعتبر است.";
}