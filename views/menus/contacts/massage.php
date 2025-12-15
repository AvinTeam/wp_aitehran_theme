<?php ( defined( 'ABSPATH' ) ) || exit;

    // dd(

    //     $first_name,
    //     $last_name,
    //     $mobile,
    //     $description,
    //     $created_at,
    //     $updated_at,

    // );

?>




<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php echo sprintf( '%s %s', $first_name, $last_name, ) ?>
    </h1>

    <hr class="wp-header-end">



    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><label for="default_category">شماره تماس</label></th>
                <td>
                    <?php echo sprintf( '<a href="tel:%s">%s</a>', $mobile, $mobile, ) ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="default_post_format">تاریخ ثبت</label></th>
                <td class="">
                    <?php echo $date ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="default_post_format">ساعت ثبت</label></th>
                <td class="">
                    <?php echo $time ?>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="default_post_format">متن</label></th>
                <td class="">
                    <?php echo $description ?>
                </td>
            </tr>



        </tbody>
    </table>

<p class="submit">
    <a class="button button-primary" href="<?php echo admin_url( 'admin.php?page=tai-contacts-us' )?>">بازگشت</a>
</p>
    <div class="clear"></div>
</div>