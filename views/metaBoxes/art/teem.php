<?php
( defined( 'ABSPATH' ) ) || exit; ?>

<p>
    <b>نام گروه</b>
    <?php echo $groupName ?>
</p>
<p>
    <b>نام خانوادگی مسئول گروه</b>
    <?php echo $leaderName ?>
</p>

<?php

if ( $teem_list ): ?>
<div class="mat_form_point">
    <div class="form-group-point">
        <label class="label" for="title_art">اعضای تیم</label>
        <ol>
            <?php

            foreach ( $teem_list as $teem ) {?>

            <li><?php echo $teem?></li>
            <?php }

            ?>
        </ol>
    </div>

</div>
<?php endif; ?>


<hr>
