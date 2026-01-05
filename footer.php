<?php

    use TAI\App\Core\Captcha;
    use TAI\App\Options\GeneralSetting;

    $general = GeneralSetting::get();

    $captcha = new Captcha();

    $captchaArray = $captcha->create_image();
?>

<footer class="container-fluid d-flex flex-column align-items-center justify-content-center pb-100">

    <span id="contact_us"
        class="py-12 w-280 text-center border border-1 border-white text-white fw-bold f-20 my-40 rounded-circle">ارتباط
        با
        ما</span>

    <div class="container">

        <div class="d-flex flex-column-reverse flex-lg-row gap-3 justify-content-center gap-5 text{#000}">

            <div class="col-12 col-lg-6 d-flex flex-column ">
                <div>
                    <form id="contact_us_form" action="" method="POST" class="">

                            <input type="hidden" id="captchaData" value="<?php echo $captchaArray[ 'key' ] ?>">


                        <?php wp_nonce_field( config( 'app.key' ) . '_contact_us' ); ?>

                        <div class="row mb-32">
                            <div class="col">
                                <input type="text" name="first_name"
                                    class="form-control form-control-lg bg-black text-white" placeholder="نام" required>
                            </div>

                            <div class="col">
                                <input type="text" name="last_name"
                                    class="form-control form-control-lg bg-black text-white" placeholder="نام خانوادگی">
                            </div>
                        </div>
                        <div class="row mb-32">
                            <div class="col">
                                <input type="text" name="mobile" inputmode="numeric" pattern="\d*" placeholder="تلفن تماس"
                                    class="form-control form-control-lg bg-black text-white onlyNumbersInput"  required>
                            </div>
                            <div class="col position-relative">
                                <input type="text" name="captcha" class="form-control form-control-lg bg-black text-white"
                                    placeholder="کد امنیتی" value="<?php echo $captchaArray[ 'word' ] ?? "" ?>" required>
                                    <img src="<?php echo $captchaArray[ 'url' ] ?>"
                                    class="h-32 d-none d-md-block position-absolute translate-middle-y"
                                    style="left: 20px; top: 50%;">
                            </div>
                        </div>
                        <div class="row mb-32  d-md-none d-block">
                             <div class="col">
                                <img src="<?php echo $captchaArray[ 'url' ] ?>" class="w-50 h-48">
                            </div>
                        </div>

                        <div class="row mb-32">
                            <div class="col">
                                <textarea class="form-control form-control-lg bg-black text-white border-0" name="description"
                                    placeholder="متن پیام" rows="5" required></textarea>
                            </div>
                        </div>


                        <div class="row mb-32">
                            <div class="col">
                                <button type="submit" name="actionForm" value="contactForm"
                                    class="btn btn-warning btn-lg mb-3 w-100">ارسال</button>
                            </div>
                        </div>


                        <div class="row mb-32">
                            <div class="col">
                                <div id="alert" class="alert alert-success d-none" role="alert">
                                    پیام شما با موفقت ثبت شد
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <img class="w-100" src="<?php echo get_the_image_url( 'logo.png' ) ?>"
                        alt="<?php echo bloginfo( 'name' ) ?>">

                </div>
            </div>

            <div class="col-12 col-lg-6 d-flex flex-column row-gap-2">
                <div class="d-flex flex-row gap-2 justify-content-start">
                    <img class="w-32 h-32" src="<?php echo get_the_image_url( 'phone.png' ) ?>">
                    <a href="tel:<?php echo sanitize_phone( $general[ 'phone' ] ) ?>" class="btn btn-link">
                        <span><?php echo $general[ 'phone' ] ?></span>
                    </a>
                </div>

                <div class="d-flex flex-row gap-2 justify-content-start">
                    <img class="w-32 h-32" src="<?php echo get_the_image_url( 'email.png' ) ?>">
                    <a href="mailto:<?php echo sanitize_email( $general[ 'email' ] ) ?>" class="btn btn-link">
                        <span><?php echo $general[ 'email' ] ?></span>
                    </a>
                </div>

                <div class="d-flex flex-row gap-2 justify-content-start">
                    <img class="w-32 h-32" src="<?php echo get_the_image_url( 'location.png' ) ?>">
                    <span class="text-white"><?php echo $general[ 'address' ] ?></span>
                </div>

                <div class="googleMap">
                    <?php echo wp_unslash( ( $general[ 'googleMap' ] ?? '' ) ) ?>
                </div>
            </div>



        </div>

    </div>

</footer>




<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="taiToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>

<?php

    // components( 'modals/share' );

?>

<!-- لودر تمام صفحه -->
<div class="overlay" id="overlay">
    <div class="loader"></div>
</div>
<?php wp_footer()?>
</body>

</html>