<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

$count_row = 0;

$meta_value = '';

// بررسی آپلود فایل
if (isset($_FILES[ 'tai_exel_ayeh' ]) && $_FILES[ 'tai_exel_ayeh' ][ 'error' ] === UPLOAD_ERR_OK) {
    $fileTmpPath   = $_FILES[ 'tai_exel_ayeh' ][ 'tmp_name' ];
    $fileName      = $_FILES[ 'tai_exel_ayeh' ][ 'name' ];
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

        foreach ($data as $rowIndex => $row) {

            if ($rowIndex === 1) {continue;}

            $meta_value .= '
                <div class="py-2 tai-page-ayeha ">
                    <div class="tai-row mx-auto d-flex flex-column">
                            <p class="mb-5"><span class="bg-success p-3 text-white f-17px rounded  ">' . $row[ 'A' ] . '</span></p>
                            <p class="tai_ayeh text-primary fw-900 f-40px  text-justify lh-lg">' . $row[ 'B' ] . '</p>


                            <div class="ayeh-address d-flex align-items-center flex-row-reverse"><span class="pe-3 text-primary">' . $row[ 'D' ] . '</span>
                            </div>

                            <p class="f-17px py-3 text-justify">' . $row[ 'C' ] . '</p>

                            <div class="w-100 divider-separator "></div>
                    </div>
                </div>
            ';

        }

    } catch (Exception $e) {
        die("خطا در خواندن فایل اکسل: " . $e->getMessage());
    }
}
