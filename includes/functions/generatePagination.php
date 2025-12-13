<?php
(defined('ABSPATH')) || exit;

if (! function_exists('generatePagination')) {

    function generatePagination($url, $per_page, $total_items, $current_page)
    {
        $allPages = ceil($total_items / $per_page);

        // اگر فقط یک صفحه وجود دارد، pagination نمایش داده نشود
        if ($allPages <= 1) {
            return [  ];
        }

        $maxVisiblePages = 5; // حداکثر تعداد صفحات قابل نمایش
        $halfVisible     = floor($maxVisiblePages / 2);

        // محاسبه محدوده صفحات قابل نمایش
        $startPage = max(1, $current_page - $halfVisible);
        $endPage   = min($allPages, $current_page + $halfVisible);

        // تنظیم startPage و endPage برای نمایش حداکثر صفحات
        if ($endPage - $startPage + 1 < $maxVisiblePages) {
            if ($startPage == 1) {
                $endPage = min($allPages, $startPage + $maxVisiblePages - 1);
            } else {
                $startPage = max(1, $endPage - $maxVisiblePages + 1);
            }
        }

        if ($current_page > 1) {

        }

        // صفحه اول (اگر در محدوده visible نباشد)
        if ($startPage > 1) {
            $result[  ] = [
                'name'   => 1,
                'link'   => add_url_param($url, [ 'page' => 1 ]),
                'action' => '',
             ];

            if ($startPage > 2) {
                $result[  ] = [
                    'name'   => '...',
                    'link'   => '',
                    'action' => 'ellipsis',
                 ];
            }
        }

        // صفحات میانی
        for ($i = $startPage; $i <= $endPage; $i++) {
            $result[  ] = [
                'name'   => $i,
                'link'   => $i == $current_page ? '#' : add_url_param($url, [ 'page' => $i ]),
                'action' => $i == $current_page ? 'active' : '',
             ];
        }

        // صفحه آخر (اگر در محدوده visible نباشد)
        if ($endPage < $allPages) {
            if ($endPage < $allPages - 1) {
                $result[  ] = [
                    'name'   => '...',
                    'link'   => '',
                    'action' => 'ellipsis',
                 ];
            }

            $result[  ] = [
                'name'   => $allPages,
                'link'   => add_url_param($url, [ 'page' => $allPages ]),
                'action' => '',
             ];
        }

        components('pagination',
            [
                'pages'    => $result ?? [  ],
                'next_btn' => [
                    'link'   => ($current_page < $allPages) ? add_url_param($url, [ 'page' => $current_page + 1 ]) : '#',
                    'action' => ($current_page < $allPages) ? '' : 'disabled',
                 ],
                'prev_btn' => [
                    'link'   => ($current_page > 1) ? add_url_param($url, [ 'page' => $current_page - 1 ]) : '#',
                    'action' => ($current_page > 1) ? '' : 'disabled',
                 ],
             ]
        );

        return;
    }
}
