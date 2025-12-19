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
                    <th scope="row"><label for="token">توکن پنل پیامک</label></th>
                    <td><input name="sms[token]" type="text" id="token" value="<?php echo $token ?? '' ?>"
                            class="regular-text d-ltr">
                    </td>

                </tr>
            </tbody>
        </table>

        <h2 class="title">ارسال کد otp</h2>
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="otpTemplateID">شناسه قالب</label></th>
                    <td><input name="sms[otp][templateID]" type="text" id="otpTemplateID"
                            value="<?php echo $otp[ 'templateID' ] ?? '' ?>" class="regular-text d-ltr">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="otpToken">متغیر OTP</label></th>
                    <td><input name="sms[otp][code]" type="text" id="otpToken"
                            value="<?php echo $otp[ 'code' ] ?? '' ?>" class="regular-text d-ltr">
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="title">ارسال ثبت نام موفق</h2>
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="registerTemplateID">شناسه قالب</label></th>
                    <td><input name="sms[register][templateID]" type="text" id="registerTemplateID"
                            value="<?php echo $register[ 'templateID' ] ?? '' ?>" class="regular-text d-ltr"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="registerToken">متغیر نام و نام خانوادگی</label></th>
                    <td><input name="sms[register][fullname]" type="text" id="registerToken"
                            value="<?php echo $register[ 'fullname' ] ?? '' ?>" class="regular-text d-ltr"></td>
                </tr>
            </tbody>
        </table>


        <h2 class="title">ارسال پس از ثبت اثر</h2>
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="artTemplateID">شناسه قالب</label></th>
                    <td><input name="sms[art][templateID]" type="text" id="artTemplateID"
                            value="<?php echo $art[ 'templateID' ] ?? '' ?>" class="regular-text d-ltr"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="artFullname">متغیر نام و نام خانوادگی</label></th>
                    <td><input name="sms[art][fullname]" type="text" id="artFullname"
                            value="<?php echo $art[ 'fullname' ] ?? '' ?>" class="regular-text d-ltr"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="artArtName">متغیر نام اثر</label></th>
                    <td><input name="sms[art][artName]" type="text" id="artArtName"
                            value="<?php echo $art[ 'artName' ] ?? '' ?>" class="regular-text d-ltr"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="artTrackingCode">متغیر کد پیگیری</label></th>
                    <td><input name="sms[art][trackingCode]" type="text" id="artTrackingCode"
                            value="<?php echo $art[ 'trackingCode' ] ?? '' ?>" class="regular-text d-ltr"></td>
                </tr>
            </tbody>
        </table>




        <p class="submit">
            <button type="submit" name="act" id="submit" value="smsSettingSubmit" class="button button-primary">ذخیرهٔ
                تغییرات</button>
        </p>
    </form>
</div>