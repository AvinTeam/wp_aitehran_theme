<?php

    $game = get_option( 'tai_game_settings', array() );

    if ( 0 === $show_first && isset( $_GET[ 'tracking_code' ] ) && ! empty( $_GET[ 'tracking_code' ] ) ):

?>

<section class="px-2 px-lg-0 mb-100  ">
    <div class="container">

        <div
            class="bg-secondary rounded-70 d-flex flex-column flex-lg-row justify-content-center align-items-center m-40 p-40 row-gap-3">

            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
                <img class="w-280" src="<?php echo get_the_image_url( 'success.png' ) ?>" alt="success">
            </div>

            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center row-gap-3">

                <h2 class="text-white">ارسال اثر با موفقیت انجام شد</h2>
                <h4 class="text-white">کد رهگیری :
                    <?php echo $_GET[ 'tracking_code' ] ?>
                </h4>
                <div class="d-flex flex-row ">
                    <a href="<?php echo home_url( '/panel/art-info' ) ?>"
                        class="btn btn-warning btn-lg rounded-40 mt-40">ارسال اثر جدید</a>
                </div>

            </div>
        </div>
    </div>
</section>

<?php else: ?>


<section class="px-2 px-lg-0 mb-100  ">
    <div class=" mt-40 container">
        <div class="d-flex flex-column flex-lg-row justify-content-between row-gap-4 row-gap-lg-0">
            <div class="col-12 col-lg-4 d-flex flex-column position-relative px-2">
                <div
                    class="bg-secondary d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24 mb-3">
                    <div class="rounded-32 w-100 text-white text-center p-16 mb-4 f-32 fw-bold">
                        ثبت نام و ارسال اثر
                    </div>

                    <div>
                        <img src="<?php echo get_the_image_url( 'panel1.png' ) ?>" alt=""
                            class="w-100 object-fit-cover rounded-65  " style="height: 478px;">
                    </div>
                </div>
                <?php view( 'panel/sidebar', $sidebarItems ); ?>
            </div>

            <div class="col-12 col-lg-8 px-2 ">

                <div class="w-100 d-flex flex-row justify-content-between align-items-center mb-32">

                    <a href="<?php echo home_url( "/panel/artList" ) ?>"
                        class="btn btn-dark rounded-32 px-24 py-2 f-24 fw-bold">
                        بازگشت
                    </a>
                </div>

                <?php getAlert(); ?>
                <form id="art_info" action="" method="post" enctype="multipart/form-data">
                    <section class="d-flex flex-column row-gap-3 w-100 bg-gray rounded-65 py-40 px-100 ">


                        <!--'formats_art' -->
                        <div
                            class="px-2 d-flex flex-column flex-lg-row justify-content-between  align-items-start  align-items-lg-center w-100 flex-nowrap bg-white border-1 border-black rounded-32 overflow-hidden">
                            <label class="col-form-label text-nowrap p-2 f-24 fw-bold f-32 text-primary">
                                <span class="text-secondary me-2">1-</span>
                                انتخاب قالب اثر<span class="text-danger">*</span>
                            </label>

                            <select class="form-select form-select-lg fw-bold f-32 text-primary" name="format_art">
                                <option value="0">--</option>
                                <?php

                                foreach ( formats_art() as $key => $item ): ?>
                                <option value="<?php echo $key ?>"
                                    <?php echo selected( $key, $formats_art ?? 0 ) ?>>
                                    <?php echo $item ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!--'art_title' -->
                        <div
                            class="px-2 d-flex flex-column flex-lg-row justify-content-between  align-items-start  align-items-lg-center w-100 flex-nowrap bg-white border-1 border-black rounded-32 overflow-hidden">

                            <label class="col-form-label text-nowrap p-2 f-24 fw-bold f-32 text-primary">
                                <span class="text-secondary me-2">2-</span>
                                عنوان اثر<span class="text-danger">*</span>
                            </label>

                            <input type="text" name="art_title" value="<?php echo $art_title ?>" require
                                class="form-control text-primary w-100 fw-bold f-32" placeholder="--">
                        </div>

                        <!--'subjects_art' -->
                        <div
                            class="px-2 d-flex flex-column flex-lg-row justify-content-between  align-items-start  align-items-lg-center w-100 flex-nowrap bg-white border-1 border-black rounded-32 overflow-hidden">

                            <label class="col-form-label text-nowrap p-2 f-24 fw-bold f-32 text-primary">
                                <span class="text-secondary me-2">3-</span>
                                انتخاب موضوع<span class="text-danger">*</span>
                            </label>

                            <select id="subject_art" class="form-select form-select-lg fw-bold f-32 text-primary" name="subject_art">
                                <option value="0">--</option>
                                <?php

                                foreach ( subjects_art() as $key => $item ): ?>
                                <option value="<?php echo $key ?>" <?php echo selected( $key, $subjects_art ?? 0 ) ?>>
                                    <?php echo $item ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="otherDiv"
                            class="px-2 <?php echo 9 == $subjects_art ? "d-flex" : "d-none" ?>  flex-column flex-lg-row justify-content-between  align-items-start  align-items-lg-center w-100 flex-nowrap bg-white border-1 border-black rounded-32 overflow-hidden">
                            <input type="text" name="subject_other_art" value="<?php echo $subject_other_art ?>"
                                class="form-control text-primary w-100 fw-bold f-32 only-fa" placeholder="موضوع را وارد کنید">
                        </div>


                        <!--'year' -->
                        <div
                            class="px-2 d-flex flex-column flex-lg-row justify-content-between  align-items-start  align-items-lg-center w-100 flex-nowrap bg-white border-1 border-black rounded-32 overflow-hidden">
                            <label class="col-form-label text-nowrap p-2 f-24 fw-bold f-32 text-primary">
                                <span class="text-secondary me-2">4-</span>
                                سال تولید اثر<span class="text-danger">*</span>
                            </label>

                            <select class="form-select form-select-lg fw-bold f-32 text-primary" name="year">
                                <?php

                                    for ( $i = 1404; $i > 1394; --$i ):

                                ?>
                                <option value="<?php echo $i ?>" <?php echo selected( $i, $year ) ?>>
                                    <?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!--'teems' -->
                        <div
                            class="px-2 d-flex flex-column justify-content-between align-items-center w-100 flex-nowrap">
                            <label
                                class="col-form-label text-nowrap px-0 px-lg-2 py-2 fw-bold f-32 text-primary w-100 text-start">
                                <span class="text-secondary me-2">5-</span>
                                نام و نام خانوادگی عوامل تولید
                            </label>


                            <div id="teem-list" class="w-100">
                                <?php

                                foreach ( $teems as $team ): ?>
                                <div
                                    class="w-100 d-flex flex-row justify-content-between align-items-center my-2 gap-2 team-item">
                                    <input type="text" name="teem[]" value="<?php echo esc_html( $team ) ?>"
                                        class="form-control text-primary w-100 fw-bold f-24 only-fa"
                                        placeholder="نام و نام خانوادگی عوامل تولید">
                                    <button onclick="this.closest('div').remove()" type="button"
                                        class="btn btn-danger btn-lg">حذف</button>
                                </div>
                                <?php
                                endforeach; ?>
                            </div>

                            <button type="button" id="add_teem"
                                class="btn btn-secondary rounded-32 w-100 p-2 my-2 f-24 fw-bold border border-1 border-black  add-item">
                                افزودن عضو جدید (+)
                            </button>
                        </div>

                        <!--'ownership' -->
                        <div
                            class="px-2 d-flex flex-column justify-content-between align-items-center w-100 flex-nowrap">
                            <label
                                class="col-form-label text-nowrap px-0 px-lg-2 py-2 fw-bold f-32 text-primary w-100 text-start">
                                <span class="text-secondary me-2">6-</span>
                                وضعیت مالکیت اثر<span class="text-danger">*</span>
                            </label>

                            <div class="w-100">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ownership" id="ownership_genuine"
                                        value="genuine" <?php echo checked( $ownership, "genuine" ) ?>>
                                    <label class="form-check-label" for="ownership_genuine">
                                        حقیقی
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ownership" id="ownership_legal"
                                        value="legal" <?php echo checked( $ownership, "legal" ) ?>>
                                    <label class="form-check-label" for="ownership_legal">
                                        حقوقی
                                    </label>
                                </div>

                                <input type="text" name="ownership_name" id="ownership_name"
                                    value="<?php echo $ownership_name ?? '' ?>" class="form-control w-100 border border-1 border-black rounded-32
                                            <?php echo( "genuine" == $ownership ) ? " d-none" : '' ?> "
                                    placeholder="نام شرکت یا نهاد حقوقی">

                            </div>

                        </div>

                        <!--'documentation' -->
                        <div
                            class="px-2 d-flex flex-column justify-content-between align-items-center w-100 flex-nowrap">
                            <label
                                class="col-form-label text-nowrap px-0 px-lg-2 py-2 fw-bold f-32 text-primary w-100 d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
                                <div> <span class="text-secondary me-2">7-</span>مستندات تولید<span
                                        class="text-danger">*</span></div>
                                <span class="w-100 f-14 text-wrap" style="color: #5A5A5A;">(پرامپت‌ها و مستندات تولید در
                                    قالب فایل
                                    zip ارسال شود.)</span>
                            </label>


                            <div id="documentation" class="w-100">
                                <input id="tai-document" name="documentation" type="hidden"
                                    value="<?php echo $documentation ?>">
                                <?php

                                    if ( ! empty( $documentation ) ) {
                                        foreach ( explode( ",", $documentation ) as $document ):

                                            $file_url = wp_get_attachment_url( $document );

                                            if ( ! $file_url ) {continue;}

                                        ?>

                                <div data-id="<?php echo $document ?>"
                                    class="w-100 d-flex flex-row justify-content-between align-items-center my-2 gap-2 image-document">

                                    <a href="<?php echo esc_url( $file_url ) ?>" type="button"
                                        class="btn btn-warning rounded-32 w-100 p-2 f-24 fw-bold documentationFile">
                                        <?php echo basename( $file_url ) ?>
                                    </a>

                                    <button id="remove-document" type="button" class="btn btn-danger">حذف</button>
                                </div>

                                <?php
                                        endforeach;
                                        }

                                    ?>
                            </div>

                            <button type="button" id="add_document"
                                class="btn btn-secondary rounded-32 w-100 p-2 my-2 f-24 fw-bold border border-1 border-black">
                                بارگذاری مستندات تولید(+) <span style="font-size: 14px;">(حداکثر ۷۰۰ مگابایت )</span>
                            </button>
                        </div>

                        <!--'art_file' -->
                        <div
                            class="px-2 d-flex flex-column justify-content-between align-items-center w-100 flex-nowrap">
                            <label
                                class="col-form-label text-nowrap px-0 px-lg-2 py-2 fw-bold f-32 text-primary w-100 d-flex flex-row align-items-center justify-content-between">
                                <div> <span class="text-secondary me-2">8-</span> بارگذاری اثر<span
                                        class="text-danger">*</span></div>
                                <span style="color: #5A5A5A; font-size: 14px;">(حداکثر ۷۰۰ مگابایت)</span>
                            </label>

                            <div id="preview_art"
                                class="w-100 d-flex flex-row justify-content-between align-items-center my-2 gap-2">

                                <?php

                                if ( ! empty( $art_file ) ): ?>
                                <a href="<?php echo esc_url( $art_file ) ?>" type="button"
                                    class="btn btn-warning rounded-32 w-100 p-2 f-24 fw-bold file_art">
                                    دانلود فایل
                                </a>
                                <?php endif; ?>

                            </div>

                            <button type="button" onclick="document.getElementById('fileInput').click();"
                                class="btn btn-secondary rounded-32 w-100 p-2 f-24 fw-bold border border-1 border-black">
                                بارگذاری فایل اثر
                            </button>

                            <input type="file" id="fileInput" style="display: none;" name="art_file"
                                accept=".zip,.rar,.7zip">
                        </div>


                        <?php

                        if ( $game[ 'status' ] ?? false ): ?>

                        <?php wp_nonce_field( config( 'app.key' ) . '_art-info' ); ?>


                        <input type="hidden" name="sendForm" value="artInfo">


                        <div class="w-100 d-flex flex-row justify-content-center align-items-center mt-32">
                            <button type="submit" class="btn btn-warning rounded-32 w-50 p-2 f-24 fw-bold mt ">
                                ارسال
                            </button>
                        </div>

                        <?php endif; ?>

                    </section>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const ownershipRadios = document.querySelectorAll('input[name="ownership"]');
    const ownershipNameInput = document.getElementById('ownership_name');

    function toggleOwnershipInput() {
        const selected = document.querySelector('input[name="ownership"]:checked');
        if (selected && selected.value === 'legal') {
            ownershipNameInput.classList.remove('d-none');
        } else {
            ownershipNameInput.classList.add('d-none');
        }
    }

    toggleOwnershipInput();

    ownershipRadios.forEach(radio => {
        radio.addEventListener('change', toggleOwnershipInput);
    });
});
</script>