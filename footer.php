<?php

    use TAI\App\Modules\NavMenus\FooterMenuWalker;
    use TAI\App\Options\GeneralSetting;

    $general = GeneralSetting::get();

?><footer class="w-100 d-flex flex-column mt-2">
    <?php if (! empty($general[ 'phone' ]) || ! empty($general[ 'email' ]) || ! empty($general[ 'address' ])): ?>
    <div class="container p-32 d-flex flex-column-reverse flex-lg-row justify-content-lg-between justify-content-start align-items-lg-center align-items-start top-footer rounded-16 z-2 row-gap-2 row-gap-lg-0 "
        style="background-color: #D6DAEF;margin-bottom: -50px;">

        <?php if (! empty($general[ 'phone' ])): ?>
        <div class="d-flex flex-row justify-content-center gap-2">
            <a href="tel:<?php echo sanitize_phone($general[ 'phone' ]) ?>"
                class="d-flex justify-content-center align-items-center gap-10">
                <img src="<?php echo get_the_image_url('bg-call.png') ?>">
                <span><?php echo $general[ 'phone' ] ?></span>
            </a>
            <span class="d-flex justify-content-center align-items-center">(زمان پاسخگویی شنبه تا پنج شنبه ساعت 9 تا 18)</span>
        </div>

        <?php endif; ?>

        <?php if (! empty($general[ 'email' ])): ?>
        <a href="mailto:<?php echo sanitize_email($general[ 'email' ]) ?>"
            class="d-flex justify-content-center align-items-center gap-10">
            <img src="<?php echo get_the_image_url('bg-email.png') ?>">
            <span><?php echo sanitize_email($general[ 'email' ]) ?></span>
        </a>

        <?php endif; ?>
        <?php if (! empty($general[ 'address' ])): ?>
        <a href="#" class="d-flex justify-content-center align-items-center gap-10">
            <img src="<?php echo get_the_image_url('bg-location.png') ?>">
            <span><?php echo $general[ 'address' ] ?></span>
        </a>
        <?php endif; ?>


    </div>


    <?php endif; ?>
    <div class="d-flex align-items-center justify-content-center"
        style="padding-top: 104px; padding-bottom: 88px; background-color: #010121; ">
        <div class="container row row-cols-1 row-cols-lg-3">
            <div>
                <div class=" mt-lg-0 mt-3">
                    <h3 class="title f-16 text-white fw-bold mb-12 position-relative">درباره زندگی با آیه ها</h3>
                    <p class="text-justify text-footer f-16 pt-24"><?php echo $general[ 'footerText' ] ?></p>
                    <div class="mt-16">
                        <img style="height: 136px;"
                            src="<?php echo get_the_image_url_by_id($general[ 'logo' ][ "footer" ]) ?>"
                            alt="<?php echo bloginfo('name') ?>">
                    </div>

                </div>
            </div>
            <div>
                <div class=" mt-lg-0 mt-3">

                    <h3 class="title f-16 text-white fw-bold mb-12 position-relative">صفحات مهم</h3>

                    <ul class="text-footer f-16 pt-24 footer-menu ps-0">
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'footer-menu',
                                'container'      => false,
                                'items_wrap'     => '%3$s',
                                'fallback_cb'    => 'footer_menu_fallback',
                                'depth'          => 1,
                                'walker'         => new FooterMenuWalker(),
                             ]);
                        ?>
                    </ul>

                </div>
            </div>
            <div>
                <div class=" mt-lg-0 mt-3">
                    <h3 class="title f-16 text-white fw-bold mb-12 position-relative">شبکه های اجتماعی</h3>

                    <div style="width: 200px;"
                        class="pt-24 socials d-flex justify-content-start align-items-center align-content-center gap-24 align-self-stretch flex-wrap">
                        <?php foreach (typeLinkArray(($general[ 'socials' ] ?? [  ])) as $key => $value): ?>
                        <a class=" d-flex justify-content-center align-items-center gap-12 p-12 rounded-circle border border-1"
                            style="border-color: #EBE0F5;" href="<?php echo esc_url($value) ?>">
                            <img class="w-24 h-24 " src="<?php echo get_the_image_url('social/' . $key . '.png') ?>">
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-center py-24 " style="background-color: #EBE0F5;">
        <div class="container d-flex flex-column flex-lg-row justify-content-lg-around">

            <p class="text-primary p-0 m-0">
                <a class="text-primary" href="https://avinmedia.ir/" target="_blank">طراحی و توسعه گروه فنی و هنری
                    آوین</a>.
            </p>
            <p class="text-primary p-0 m-0">
                2022-2024  © All  Rights    Reserved
            </p>
        </div>
    </div>

</footer>

<?php

    components('modals/search');
    components('modals/share');

?>

<!-- لودر تمام صفحه -->
<div class="overlay" id="overlay">
    <div class="loader"></div>
</div>
<script type="text/javascript">
;
!(function(w, d) {
    'use strict';
    d.write(
        '<div class="opacity-0 d-none" id="amarfa-stats-13367" style="display: inline-block height: 0px; width: 0px;  "></div>'
    );
    d.write('<' + 'sc' + 'ript type="text/javasc' + 'ri' + 'pt" src="//amarfa.ir/stats/13367.js" async><' + '/' +
        'scri' + 'pt>');
})(this, document);
</script>
<?php wp_footer()?>
</body>

</html>