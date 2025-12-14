<?php

    use TAI\App\Options\GeneralSetting;

    $general = GeneralSetting::get();

?>

<footer class="w-100 d-flex flex-column mt-2">
footer
</footer>

<?php

    components( 'modals/search' );
    components( 'modals/share' );

?>

<!-- لودر تمام صفحه -->
<div class="overlay" id="overlay">
    <div class="loader"></div>
</div>
<?php wp_footer()?>
</body>

</html>