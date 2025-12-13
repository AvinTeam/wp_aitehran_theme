                <div class="p-2">
                    <div class="bg-media rounded-16 p-16">
                        <div class="d-flex flex-row justify-content-between align-items-center gap-12 mb-16">

                            <div class="d-flex flex-row justify-content-start align-items-center gap-12">
                                <!-- <img src="<?php echo $image ?? '' ?>"
                                    class="img-fluid object-fit-cover rounded-circle w-45 h-45 "> -->
                                <p class="m-0 p-0 text-start text-primary f-16 text-1-lines"><?php echo $title ?? '' ?>
                                </p>

                            </div>
                            <div class="d-flex flex-row justify-content-end align-items-center gap-10">
                                <button type="button"
                                    class="btn btn-light rounded-12 px-8 py-2 f-14 text-nowrap shareLink"
                                    data-shareLink="<?php echo $surah_link ?? '#' ?>">
                                    <img src="<?php echo get_the_image_url('share.png') ?>" alt="share">
                                </button>
                                <a href="<?php echo $link ?? '' ?>" download=""
                                    class="btn btn-light rounded-12 px-8 py-2 f-14 text-nowrap">
                                    <img src="<?php echo get_the_image_url('download.png') ?>" alt="download">
                                </a>
                            </div>
                        </div>
                        <div>
                            <audio class="w-100 rounded" controls preload="none">
                                <source src="<?php echo $link ?? '' ?>" type="audio/mpeg">
                                مرورگر شما از تگ audio پشتیبانی نمی‌کند.
                            </audio>
                        </div>


                        <?php if (isset($campaign_link) && isset($campaign_title) && isset($surah_link) && isset($surah)): ?>

                        <p class="text-1-lines text-primary"><?php echo $description ?? '' ?></p>
                        <div class="d-flex flex-row justify-content-between align-items-center mt-16">
                            <div class="d-flex flex-row justify-content-between align-items-center gap-1">
                                <a href="<?php echo $campaign_link ?? '' ?>"
                                    class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap">پویش
                                    <?php echo $campaign_title ?? '' ?></a>
                                <a href="<?php echo $surah_link ?? '#' ?>"
                                    class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap"><?php echo $surah ?? '' ?></a>
                            </div>
                            <a href="#" class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap">صوت</a>
                        </div>

                        <?php endif; ?>
                    </div>
                </div>