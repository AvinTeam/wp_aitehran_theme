<?php
(defined('ABSPATH')) || exit;

use PhpOffice\PhpSpreadsheet\IOFactory;
use TAI\App\Models\Gifts;
use TAI\App\Models\Winners;

$count_row = 0;

$meta_value = '';
$massage    = '';

if (isset($_FILES[ "winner_file" ]) && $_FILES[ "winner_file" ][ 'error' ] === UPLOAD_ERR_OK) {
    $fileTmpPath   = $_FILES[ "winner_file" ][ 'tmp_name' ];
    $fileName      = $_FILES[ "winner_file" ][ 'name' ];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowedExtensions = [ 'xls', 'xlsx' ];
    if (! in_array($fileExtension, $allowedExtensions)) {

        $massage .= '<p><strong>فرمت فایل پشتیبانی نمی‌شود. لطفاً یک فایل اکسل انتخاب کنید.</strong></p>';
        set_transient('general_transient', '<div id="message" class="notice notice-error">' . $massage . '</div>');
        throw new Exception('error', 404);
    }

    $spreadsheet = IOFactory::load($fileTmpPath);
    $sheet       = $spreadsheet->getActiveSheet();
    $data        = $sheet->toArray(null, true, true, true);

    $array['lottery'] = $_POST[ 'winner' ][ 'date' ];

    foreach ($data as $rowIndex => $row) {

        if ($rowIndex === 1) {continue;}

        if (! sanitize_mobile($row[ "A" ])) {
            $massage .= '<p><strong>ردیف ' . $rowIndex . ' شماره موبایل به درستی وارد نشده است</strong></p>';
        }
        if (empty($row[ "B" ])) {
            $massage .= '<p><strong>ردیف ' . $rowIndex . ' نام و نام خانوادگی وارد نشده است</strong></p>';
        }

            $array['mobile'] = sanitize_mobile($row[ "A" ]);
            $array['full_name'] = $row[ "B" ];

        $winners[  ] = $array;

    }

    if (! empty($massage)) {

        set_transient('general_transient', '<div id="message" class="notice notice-error">' . $massage . '</div>');
        throw new Exception('error', 404);
    }

    $gift_id = absint($_POST[ 'winner' ][ 'gift_id' ]);

    Gifts::find($gift_id)->deleteWinners(absint($_POST[ 'winner' ][ 'campaign_id' ]));

    foreach ($winners ?? [  ] as $winner) {

        $winner[ 'campaign_id' ] = absint($_POST[ 'winner' ][ 'campaign_id' ]);
        $winner[ 'gift_id' ]     = $gift_id;

        Winners::create($winner);

    }

}
