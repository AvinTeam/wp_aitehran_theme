
<?php if(!isset($_GET["rashidpour"])):?>

<style>

.user-comment-shortcuts-wrap,
.user-language-wrap,
.user-display-name-wrap,
.show-admin-bar.user-admin-bar-front-wrap,
.user-syntax-highlighting-wrap,
.user-email-wrap,
.user-url-wrap,
.user-description-wrap,
.user-profile-picture,
.user-pass1-wrap,
.application-passwords.hide-if-no-js,
#your-profile h2,
.user-admin-color-wrap {
    display: none;
}



</style>

<?php endif; ?>




<h2>اطلاعات جانبی کاربر</h2>
<table class="form-table">
    <tbody>

        <tr class="user-leader-wrap  leader_roll_selector  <?php if (empty($mat_leader_option)) {echo 'mat-dn';}?>">
            <th><label for="leader"><?=($user_role == 'mat_referee') ? 'مدیر' : 'سر تیم';?></label></th>
            <td>
                <select name="leader" id="leader">

                    <?php $user_is_admin = wp_get_current_user();?>

                    <option <?=selected(get_current_user_id(), $user_leader)?> value="<?=get_current_user_id()?>">
                        <?=$user_is_admin->display_name?> </option>
                    <?php foreach ($mat_leader_option??[] as $key => $value): ?>
                    <option <?=selected($value->ID, $user_leader)?> value="<?=$value->ID?>"><?=$value->display_name?>
                    </option>
                    <?php endforeach;?>
                </select>
            </td>
        </tr>


        <tr class="user-first-name-wrap">
            <th>
                <label for="mobile">شماره تلفن</label>
            </th>
            <td>
                <input type="text" class="regular-text" name="mobile" inputmode="tel" placeholder="شماره همراه"
                    value="<?php echo esc_attr($mobile); ?>">
            </td>
        </tr>
        
        <tr class="user-first-name-wrap">
            <th>
                <label for="parent">تام پدر</label>
            </th>
            <td>
                <input type="text" class="regular-text" name="parent" placeholder="نام پدر"
                    value="<?php echo esc_attr($parent); ?>">
            </td>
        </tr>
        <tr class="user-first-name-wrap">
            <th>
                <label for="nationalCode">کد ملی</label>
            </th>
            <td>
                <input type="text" class="regular-text" name="nationalCode" inputmode="tel" placeholder="کد ملی"
                    value="<?php echo esc_attr($nationalCode); ?>">
            </td>
        </tr>


        <tr class="user-first-name-wrap">
            <th>
                <label for="birthday">تاریخ تولد</label>
            </th>
            <td>
                <input type="text" class="regular-text" name="birthday" placeholder="تاریخ تولد"
                    value="<?php echo esc_attr($birthday); ?>">
            </td>
        </tr>

        <tr class="user-first-name-wrap">
            <th>
                <label for="edu">مدرک تحصیلی</label>
            </th>
            <td>
                <input type="text" class="regular-text" name="edu" placeholder="مدرک تحصیلی"
                    value="<?php echo esc_attr($edu); ?>">
            </td>
        </tr>

        <tr class="user-address-wrap">
            <th>
                <label for="address">محل سکونت </label>
            </th>
            <td>
                <input type="text" class="regular-text" name="address" placeholder="محل سکونت"
                    value="<?php echo esc_html($address); ?>">
            </td>
        </tr>
        <tr class="user-addressPost-wrap">
            <th>
                <label for="addressPost">آدرس پستی</label>
            </th>
            <td>
                <textarea name="addressPost" rows="5" cols="30"><?php echo esc_html($addressPost); ?></textarea>
            </td>
        </tr>
    </tbody>
</table>