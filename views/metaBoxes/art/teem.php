<?php
( defined( 'ABSPATH' ) ) || exit; ?>

<p>سر تیم: <?php echo $leader_name ?></p>

<hr>

<div class="mat_form_point">
    <div class="form-group-point">
        <label class="label" for="title_art">اعضای تیم</label>
        <ol>
            <?php

            foreach ( $art_teem_list as $key => $teem ) {?>

            <li><?php echo $teem[ 'name' ] ?></li>
            <?php }

            ?>
        </ol>
    </div>

</div>