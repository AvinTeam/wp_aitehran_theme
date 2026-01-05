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
                    <th scope="row"><label for="token">ثبت و ویرایش آثار</label></th>
                    <td>

                    <td>
                        <fieldset>
                            <label for="users_can_register">
                        <input name="game[status]" type="checkbox" id="users_can_register" value="1"
                        <?php checked( $status ?? false )?> >
                            کاربر امکان ثبت و ویرایش آثار را دارد</label>
                        </fieldset>
                    </td>
                </td>

                </tr>
            </tbody>
        </table>

        <p class="submit">
            <button type="submit" name="act" id="submit" value="gameSettingSubmit" class="button button-primary">ذخیرهٔ
                تغییرات</button>
        </p>
    </form>
</div>