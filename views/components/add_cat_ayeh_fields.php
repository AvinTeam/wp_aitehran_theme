<div class="form-field term-slug-wrap">
    <label>وضعیت</label>
    <fieldset class="d-flex gap-1">
        <label>
            <input type="radio" name="status" value="active">
            <span class="date-time-text">فعال</span>
        </label>

        <label>
            <input type="radio" name="status" value="notActive" checked>
            <span class="date-time-text">غیر فعال</span>
        </label>
    </fieldset>
</div>

<div class="form-field term-slug-wrap">
    <label for="display_order">ترییب</label>
    <input name="display_order" id="display_order" type="number" value="0" min="0" >
</div>

<div class="form-field">
    <label for="poster">پوستر</label>
    <input type="hidden" name="poster" id="poster" value="" />
    <div id="poster_preview" style="margin: 10px 0; display: none;">
        <img src="" style="max-width: 200px; height: auto;" />
    </div>
    <input type="button" class="button button-secondary" id="upload_poster" value="آپلود پوستر" />
    <input type="button" class="button button-secondary" id="remove_poster" value="حذف پوستر" style="display: none;" />
</div>
