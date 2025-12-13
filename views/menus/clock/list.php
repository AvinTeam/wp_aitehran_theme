<?php
    defined('ABSPATH') || exit;
    global $title;
?>
<div id="wpbody-content">
    <div class="wrap nosubsub">
        <h1 class="wp-heading-inline"><?php echo $title ?></h1>
        <hr class="wp-header-end">
        <div id="col-container" class="wp-clearfix">
            <div id="col-left">
                <div class="col-wrap">
                    <div class="form-wrap">
                        <h2>افزودن زمان تازه</h2>
                        <form id="addtag" method="post" action="" class="validate">
                            <?php wp_nonce_field(config('app.key') . '_clock_' . get_current_user_id()); ?>

                            <div class="form-field term-slug-wrap">
                                <label for="title">عنوان</label>
                                <input name="clock[title]" id="title" type="text" class="regular-text">
                            </div>

                            <div class="form-field term-slug-wrap">
                                <label for="mrdata">تاریخ</label>
                                <input name="clock[date]" id="mrdata" type="text" class="regular-text" data-jdp=""
                                    data-jdp-only-date="" data-jdp-min-date="today">
                            </div>

                            <div class="form-field term-slug-wrap">
                                <label for="mrtime">ساعت</label>
                                <input name="clock[time]" id="mrtime" type="text" class="regular-text" data-jdp=""
                                    data-jdp-only-time="">
                            </div>

                            <p class="submit">
                                <button type="submit" name="act" id="submit" class="button button-primary"
                                    value="add-clock">افزودن</button> <span class="spinner"></span>
                            </p>
                        </form>
                    </div>
                </div>
            </div><!-- /col-left -->

            <div id="col-right">
                <div class="col-wrap">
                    <?php
                        $clockTable->prepare_items();
                        $clockTable->display();
                    ?>
                </div>
            </div><!-- /col-right -->

        </div><!-- /col-container -->

    </div><!-- /wrap -->

    <div class="clear"></div>
</div>