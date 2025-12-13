<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use taiclass\TAIDB;

$taidb = new TAIDB('winners');

$count_row = 0;

// بررسی آپلود فایل
if (isset($_FILES[ 'excel_file' ]) && $_FILES[ 'excel_file' ][ 'error' ] === UPLOAD_ERR_OK) {
    $fileTmpPath   = $_FILES[ 'excel_file' ][ 'tmp_name' ];
    $fileName      = $_FILES[ 'excel_file' ][ 'name' ];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // بررسی فرمت فایل
    $allowedExtensions = [ 'xls', 'xlsx' ];
    if (! in_array($fileExtension, $allowedExtensions)) {
        die("فرمت فایل پشتیبانی نمی‌شود. لطفاً یک فایل اکسل انتخاب کنید.");
    }

    try {

        $taidb->empty();
        // خواندن فایل اکسل
        $spreadsheet = IOFactory::load($fileTmpPath);
        $sheet       = $spreadsheet->getActiveSheet();          // شیت فعال
        $data        = $sheet->toArray(null, true, true, true); // تبدیل به آرایه

        foreach ($data as $rowIndex => $row) {

            if ($rowIndex === 1) {continue;}

            $mappedRow = [

                'gift'   => $row[ 'A' ],
                'mobile' => sanitize_mobile($row[ 'B' ]),

             ];

            $insert_id = $taidb->insert($mappedRow);

            $count_row++;

        }

    } catch (Exception $e) {
        die("خطا در خواندن فایل اکسل: " . $e->getMessage());
    }
}
