<?php
    use TAI\App\Enums\SectionsEnums;
    defined('ABSPATH') || exit;
    global $title;
?>
<div class="wrap">
    <h1><?php echo $title ?></h1>

    <form method="post" action="" novalidate="novalidate">
        <?php wp_nonce_field(config('app.key') . '_sections_setting_' . get_current_user_id()); ?>
        <table class="form-table" role="presentation">

            <tbody>

                <tr>
                    <th scope="row"><label for="games"><?php echo SectionsEnums::games ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[games]" id="games"
                            class="regular-text"><?php echo $games ?? '' ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="banners"><?php echo SectionsEnums::banners ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[banners]" id="banners"
                            class="regular-text"><?php echo $banners ?? '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="gifts"><?php echo SectionsEnums::gifts ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[gifts]" id="gifts"
                            class="regular-text"><?php echo $gifts ?? '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="winners"><?php echo SectionsEnums::winners ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[winners]" id="winners"
                            class="regular-text"><?php echo $winners ?? '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="media"><?php echo SectionsEnums::media ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[media]" id="media"
                            class="regular-text"><?php echo $media ?? '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="news"><?php echo SectionsEnums::news ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[news]" id="news"
                            class="regular-text"><?php echo $news ?? '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="faq"><?php echo SectionsEnums::faq ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[faq]" id="faq"
                            class="regular-text"><?php echo $faq ?? '' ?></textarea>
                    </td>
                </tr>
                </tr>

                <tr>
                    <th scope="row"><label for="poster"><?php echo SectionsEnums::poster ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[poster]" id="poster"
                            class="regular-text"><?php echo $poster ?? '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="supported"><?php echo SectionsEnums::supported ?></label></th>
                    <td>
                        <textarea rows="5" name="sections[supported]" id="supported"
                            class="regular-text"><?php echo $supported ?? '' ?></textarea>
                    </td>
                </tr>

            </tbody>
        </table>



        <p class="submit">
            <button type="submit" name="act" id="submit" value="submit_sections" class="button button-primary">ذخیرهٔ
                تغییرات</button>
        </p>
    </form>
</div>