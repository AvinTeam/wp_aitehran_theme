<tr class="form-field">
    <th scope="row">
        <label for="poster">پوستر</label>
    </th>
    <td>
        <input type="hidden" name="poster" id="poster" value="<?php echo esc_attr($poster_id); ?>" />
        <div id="poster_preview" style="margin: 10px 0;">
            <?php if ($poster_url): ?>
            <img src="<?php echo esc_url($poster_url) ?? ''; ?>" style="max-width: 200px; height: auto;" />
            <?php endif; ?>
        </div>
        <input type="button" class="button button-secondary" id="upload_poster" value="آپلود پوستر" />
        <input type="button" class="button button-secondary" id="remove_poster" value="حذف پوستر"
            style="<?php echo ! $poster_id ? 'display: none;' : ''; ?>" />
    </td>
</tr>
<tr class="form-field term-description-wrap">
    <th scope="row"><label for="description">آپلود آیه ها</label></th>
    <td><input type="file" id="cat_ayeh_file" name="cat_ayeh_file"
            accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
        <a href="<?php echo get_upload_url('ayeh.xlsx') ?>">نمونه فایل</a>
    </td>
</tr>
<tr class="form-field">
    <th scope="row">
        <label for="icon">ترتیب</label>
    </th>
    <td>
        <input name="display_order" id="display_order" type="number" value="<?php echo $display_order ?? 0 ?>" min="0">

    </td>
</tr>
<tr class="form-field">
    <th scope="row">
        <label for="icon">وضعیت</label>
    </th>
    <td>
        <fieldset class="d-flex gap-1">
            <label>
                <input type="radio" name="status" value="active" <?php checked($status, 'active')?> />
                <span class="date-time-text">فعال</span>
            </label>

            <label>
                <input type="radio" name="status" value="notActive" <?php checked($status, 'notActive')?> />
                <span class="date-time-text">غیر فعال</span>
            </label>
        </fieldset>
    </td>
</tr>

<tr class="form-field">
    <th scope="row">
        <label for="icon">نمایش برنده ها</label>
    </th>
    <td>
        <fieldset class="d-flex gap-1">
            <label>
                <input type="radio" name="winnerStatus" value="active" <?php checked($winnerStatus, 'active')?>>
                <span class="date-time-text">فعال</span>
            </label>

            <label>
                <input type="radio" name="winnerStatus" value="notActive" <?php checked($winnerStatus, 'notActive')?>>
                <span class="date-time-text">غیر فعال</span>
            </label>
        </fieldset>
    </td>
</tr>
<tr class="form-field">
    <th scope="row">
        <label for="icon">لیست جوایز</label>
    </th>
    <td>
        <input type="hidden" id="gift_ids" name="gift_ids" value="<?php echo $git_list_id ?? "" ?>">

        <ui id="gift-list">
            <?php foreach ($git_list as $gift): ?>
            <li class="d-flex justify-content-start gap-1 align-items-center " data-id="<?php echo $gift[ 'id' ] ?>">
                <span style="min-width: 200px;" class="ms-2"><?php echo $gift[ 'title' ] ?>
                    (<?php echo $gift[ 'winner_count' ] ?> برنده)</span>
                <span style="min-width: 200px;" class="ms-2"> <b>تاریخ قرعه کشی:</b>
                    <?php echo $gift[ 'lottery' ] ?></span>
                <button type="button" class="button" id="upload" data-id="<?php echo $gift[ 'id' ] ?>">بارگذاری برنده
                    ها</button>
                <button type="button" class="button button-error" id="remove">حذف</button>
            </li>
            <?php endforeach; ?>
        </ui>
        <div class="mt-5 d-flex align-items-center gap-2">
            <select id="select2GiftList" name="gift_list" style="min-width: 150px;">
                <option value=""></option>
                <?php foreach ($all_gift as $gift): ?>
                <option value="<?php echo $gift[ 'id' ] ?>"><?php echo $gift[ 'title' ] ?></option>
                <?php endforeach; ?>
            </select>
            <button id="add_gift" type="button" class="button button-success">افزودن</button>
        </div>
    </td>
</tr>


<?php echo get_the_transient() ?>


<div class="modal" id="modalWinner">
    <div class="modal-header">
        <h3 class="modal-title">بارگذاری برنده ها</h3>
        <button type="button" class="modal-close close">&times;</button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="winner[campaign_id]" value="<?php echo intval($_GET[ 'tag_ID' ]) ?>">
        <input type="hidden" name="winner[gift_id]" id="gift_id">
        <div class="mb-3 d-flex align-items-center gap-3">
            <span>تاریخ قرعه کشی</span>
            <input name="winner[date]" id="winner-date" type="text" class="regular-text" data-jdp=""
                data-jdp-only-date="" data-jdp-max-date="today" require>
        </div>
        <div class="mb-3 d-flex align-items-center gap-3">
            <span>فایل اکسل</span>
            <input name="winner_file" type="file" accept=".xlsx, .xls">
            <a href="<?php echo get_upload_url('winner.xlsx') ?>">نمونه اکسل</a>
        </div>

    </div>
    <div class="modal-footer">
        <button class="button button-error modal-close" type="button">بستن</button>
        <button class="button button-primary" type="button" ّ id="modal-submit">ذخیره تغییرات</button>
    </div>
</div>