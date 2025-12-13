<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

$count_row = 0;

$meta_value = '';

// بررسی آپلود فایل
if (isset($_FILES[ 'tai_exel_winners' ]) && $_FILES[ 'tai_exel_winners' ][ 'error' ] === UPLOAD_ERR_OK) {
    $fileTmpPath   = $_FILES[ 'tai_exel_winners' ][ 'tmp_name' ];
    $fileName      = $_FILES[ 'tai_exel_winners' ][ 'name' ];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // بررسی فرمت فایل
    $allowedExtensions = [ 'xls', 'xlsx' ];
    if (! in_array($fileExtension, $allowedExtensions)) {
        die("فرمت فایل پشتیبانی نمی‌شود. لطفاً یک فایل اکسل انتخاب کنید.");
    }

    try {
        // خواندن فایل اکسل
        $spreadsheet = IOFactory::load($fileTmpPath);
        $sheet       = $spreadsheet->getActiveSheet();          // شیت فعال
        $data        = $sheet->toArray(null, true, true, true); // تبدیل به آرایه

        $meta_value .= '

        <div class="mb-3">
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1  bg-primary-400" style="height: 1px;"></div>
            <span class="mx-3">' . sanitize_text_field($_POST[ 'tai_row_title' ]) . '</span>
            <div class="flex-grow-1 bg-primary-400" style="height: 1px;"></div>
        </div>
        <div class="row row-cols-lg-3 row-cols-1">';

        foreach ($data as $rowIndex => $row) {

            if ($rowIndex === 1) {continue;}

            if (absint($row[ 'A' ])) {
                $meta_value .= '<div class="col px-2 my-2 winner"><div class="d-flex flex-row align-items-center justify-content-between border border-2 rounded-3  border-secondary m-0 p-0 overflow-hidden" style="height: 40px;"><div class="w-100 d-flex flex-row align-items-center justify-content-start h-100"><span class="row-count h-100 d-flex flex-row align-items-center justify-content-center text-white fw-900 px-3">' . $row[ 'A' ] . '</span><span class="bg-gradient h-100 w-100 d-flex flex-row align-items-center justify-content-center text-white fw-900">' . $row[ 'B' ] . '</span></div><div class="mobile h-100 d-flex flex-row align-items-center justify-content-center fw-900">' . mobile_mask($row[ 'C' ]) . '</div></div></div>';

            } else {

                $meta_value .= ' <div class="col px-2 my-2"><div class="d-flex flex-column align-items-center justify-content-between border border-2 rounded-3  border-secondary m-0 p-0 overflow-hidden" style="height: 140px;"><span class="row-count h-100 w-100 d-flex flex-row align-items-center justify-content-center text-white fw-900 px-3">' . $row[ 'A' ] . '</span><span class="bg-gradient h-100 w-100 d-flex flex-row align-items-center justify-content-center text-white fw-900">' . $row[ 'B' ] . '</span><span class="mobile h-100 d-flex flex-row align-items-center justify-content-center fw-900">' . mobile_mask($row[ 'C' ]) . '</span></div></div>';

            }

        }

        $meta_value .= '</div></div>';

    } catch (Exception $e) {
        die("خطا در خواندن فایل اکسل: " . $e->getMessage());
    }
}