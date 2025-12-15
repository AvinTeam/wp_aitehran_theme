<?php ( defined( 'ABSPATH' ) ) || exit;
global $title; ?>




<div class="wrap">
    <h1 class="wp-heading-inline">
 <?php echo esc_html( $title ) ?>
</h1>

    <hr class="wp-header-end">



<?php

    $table->prepare_items();

    echo '<form method="post" action=""';
    $table->views();
    $table->search_box( 'جست‌ و جو', 'search_tai' );

    $table->display();
?>

</form>




    <div class="clear"></div>
</div>