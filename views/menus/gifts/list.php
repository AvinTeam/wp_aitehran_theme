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
                        <form id="addtag" method="post" action="" class="validate">
                            <?php wp_nonce_field(config('app.key') . '_gift_' . get_current_user_id()); ?>
                            <input name="gift[id]" type="hidden" value="<?php echo $id ?>">

                            <div class="form-field term-slug-wrap">
                                <label for="title">عنوان</label>
                                <input name="gift[title]" id="title" type="text" value="<?php echo $gtitle ?>"
                                    class="regular-text">
                            </div>
                            <div class="form-field term-slug-wrap">
                                <label for="mrdata">تصویر</label>
                                <section class="">
                                    <img src="<?php echo $image_url ?>"
                                        style="max-height: 100px; width: auto;<?php echo ! $id ? 'display: none;' : ''; ?>">
                                    <div>
                                        <input type="hidden" name="gift[image]" value="<?php echo $image_id ?>">
                                        <p class="d-flex flex-row justify-content-start gap-1">
                                            <button type="button" class="button button-secondary select_gallery"
                                                data-title="انتخاب تصویر" data-buttontext="انتخاب تصویر"
                                                data-type="image">انتخاب</button>

                                            <button type="button" action="clean" class="button button-error "
                                                style="<?php echo ! $id ? 'display: none;' : ''; ?>">حذف</button>
                                        </p>
                                    </div>
                                </section>
                            </div>

                            <p class="submit">
                                <button type="submit" name="act" id="submit" class="button button-primary"
                                    value="<?php echo $btn_value ?>"><?php echo $btn_text ?></button>

                                <?php if ($update): ?>
                                <a href="<?php echo admin_url('edit.php?post_type=content_ayeh&page=gifts') ?>"
                                    class="button">برگشت</a>
                                <?php endif; ?>
                            </p>
                        </form>
                    </div>
                </div>
            </div><!-- /col-left -->

            <div id="col-right">
                <div class="col-wrap">
                    <form id="posts-filter" method="post" action="">
                        <?php
                            $table->prepare_items();
                            $table->search_box('جستجو', 'site-search');
                            $table->views();
                            $table->display();
                        ?>

                    </form>
                </div>
            </div><!-- /col-right -->

        </div><!-- /col-container -->

    </div><!-- /wrap -->

    <div class="clear"></div>
</div>