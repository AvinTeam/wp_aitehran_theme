<?php
    defined( 'ABSPATH' ) || exit;
    global $title;

?>
<div class="wrap">
    <h1><?php echo $title ?></h1>

    <form method="post" action="" novalidate="novalidate">
        <?php wp_nonce_field( config( 'app.key' ) . '_setting_' . get_current_user_id() ); ?>
        <table class="form-table" role="presentation">

            <tbody>

                <tr>
                    <th scope="row"><label for="address">آدرس</label></th>
                    <td><input name="setting[address]" type="text" id="address" value="<?php echo $address ?? '' ?>"
                            class="regular-text"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="email">ایمیل</label></th>
                    <td><input name="setting[email]" type="email" id="email" value="<?php echo $email ?? '' ?>"
                            class="regular-text"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="phone">شماره تماس</label></th>
                    <td><input name="setting[phone]" type="text" id="phone" value="<?php echo $phone ?? '' ?>"
                            class="regular-text d-ltr"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="googleMap">نقشه گوگل</label></th>

                    <td>
                        <textarea rows="5" name="setting[googleMap]" id="googleMap"
                            class="w-100 d-ltr"><?php echo wp_unslash( ( $googleMap ?? '' ) ) ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="socials">شبکه های اجنماعی</label></th>

                    <td>
                        <div class="select-input">
                            <ul id="link-list">
                                <?php
                                    $m = 1;

                                foreach ( typeLinkArray( ( $socials ?? array(  ) ) ) as $type => $social ): ?>
                                <li>
                                    <select name="setting[socials][<?php echo $m ?>][type]">
                                        <?php
                                        foreach ( config( 'app.socials', array(  ) ) as $key => $name ): ?>
                                        <option<?php selected( $key, $type )?> value="<?php echo $key ?>">
                                            <?php echo $name ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                    <input name="setting[socials][<?php echo $m ?>][link]" type="url"
                                        class="regular-text" value="<?php echo esc_url( $social ) ?>">
                                    <button id="remove-link-item" onclick="this.closest('li').remove()" type="button"
                                        class="button button-error">حذف</button>
                                </li>
                                <?php
                                    ++$m;
                                endforeach; ?>

                            </ul>

                            <button type="button" data-nextItem="<?php echo $m ?>" data-type="socials"
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