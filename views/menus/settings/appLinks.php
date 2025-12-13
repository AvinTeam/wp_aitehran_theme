<?php
    defined('ABSPATH') || exit;
    global $title;

?>
<div class="wrap">
    <h1><?php echo $title ?></h1>

    <form method="post" action="" novalidate="novalidate">
        <?php wp_nonce_field(config('app.key') . '_app_links_setting_' . get_current_user_id()); ?>
        <table class="form-table" role="presentation">

            <tbody>
                <tr>

                    <td>
                        <div class="select-input">
                            <ul id="link-list">
                                <?php
                                    $m = 1;
                                foreach (typeLinkArray(($appLinks ?? [  ])) as $type => $link): ?>
                                <li>
                                    <select name="setting[appLinks][<?php echo $m ?>][type]">
                                        <?php foreach (config('app.appLinks', [  ]) as $key => $name): ?>
                                        <option<?php selected($key, $type)?> value="<?php echo $key ?>">
                                            <?php echo $name ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                    <input name="setting[appLinks][<?php echo $m ?>][link]" type="url"
                                        class="regular-text" value="<?php echo esc_url($link) ?>">
                                    <button id="remove-link-item" onclick="this.closest('li').remove()" type="button"
                                        class="button button-error">حذف</button>
                                </li>
                                <?php
                                    $m++;
                                endforeach; ?>

                            </ul>

                            <button type="button" data-nextItem="<?php echo $m ?>" data-type="appLinks"
                                class="button button-success add-item">
                                افزودن
                            </button>

                        </div>
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