<?php
    defined('ABSPATH') || exit;
    global $title;
?>
<div class="wrap">
    <h1><?php echo $title ?></h1>

    <form method="post" action="" novalidate="novalidate">
        <?php wp_nonce_field(config('app.key') . '_logo_setting_' . get_current_user_id()); ?>
        <table class="form-table" role="presentation">

            <tbody>
                <tr>
                    <th scope="row"><label for="header">لوگو هدر</label></th>
                    <td> <input type="hidden" name="setting[logo][header]" id="header"
                            value="<?php echo esc_attr($header->id); ?>" />
                        <div id="logo_preview" style="margin: 10px 0;">
                            <img src="<?php echo esc_url($header->url); ?>" style="max-width: 200px; height: auto;" />
                        </div>
                        <button type="button" class="button button-secondary upload_logo" date-text="هدر">انتخاب
                            لوگو</button>
                        <p class="description">لوگو هدر سایت را انتخاب کنید</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="footer">لوگو فوتر</label></th>
                    <td> <input type="hidden" name="setting[logo][footer]" id="footer"
                            value="<?php echo esc_attr($footer->id); ?>" />
                        <div id="logo_preview" style="margin: 10px 0;">
                            <img src="<?php echo esc_url($footer->url); ?>" style="max-width: 200px; height: auto;" />
                        </div>
                        <button type="button" class="button button-secondary upload_logo" date-text="فوتر">انتخاب
                            لوگو</button>
                        <p class="description">لوگو فوتر سایت را انتخاب کنید</p>
                    </td>
                </tr>
            </tbody>
        </table>



        <p class="submit">
            <button type="submit" name="act" id="submit" value="settingSubmit" class="button button-primary">ذخیرهٔ
                تغییرات</button>
        </p>
    </form>
</div>