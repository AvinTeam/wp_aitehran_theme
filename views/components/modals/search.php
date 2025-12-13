<?php
    use TAI\App\Enums\MediaEnums;
?>
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">جست و جو</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body">
                <!-- فرم جستجو -->
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <div class="mb-3">
                        <input type="text" name="s" class="form-control  form-control-lg" id="s" placeholder="متن جستجو"
                            value="<?php echo get_search_query(); ?>">
                        <p class="mt-24 text-primary fw-bold f-20">جست و جو در : </p>

                        <div class="d-flex flex-row justify-content-start align-items-center gap-16">
                            <button type="submit" name="type" value="news" class="btn btn-primary">اخبار</button>
                            <button type="submit" name="type" value="ayeh" class="btn btn-primary">محتوا مسابقه</button>
                            <button type="submit" name="type" value="<?php echo MediaEnums::VIDEO ?>"
                                class="btn btn-primary">ویدئو ها</button>
                            <button type="submit" name="type" value="<?php echo MediaEnums::SOUND ?>"
                                class="btn btn-primary">صوت ها</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>