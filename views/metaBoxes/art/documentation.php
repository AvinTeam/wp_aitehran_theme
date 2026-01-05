<?php
( defined( 'ABSPATH' ) ) || exit; ?>


<div class="d-flex flex-column align-items-start gap-2">
    <b>مستندات تولید</b>
<div class="d-flex flex-row align-items-center gap-2">

    <?php foreach ( $documentation as $doc ) :?>

            <a href="<?php echo $doc ?>" target="_blank" class="button">دانلود فایل</a>

    <?php endforeach; ?>
</div>

</div>

<hr>
