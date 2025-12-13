                <div class="p-2">
                    <div class="bg-media rounded-16 p-16" style="min-height: 400px !important;">
                        <div class="d-flex flex-row justify-content-between align-items-center gap-12 mb-16">

                            <div class="d-flex flex-row justify-content-start align-items-center gap-12">
                                <!-- <img src="<?php echo $image ?? '' ?>"
                                    class="img-fluid object-fit-cover rounded-circle w-45 h-45 "> -->
                                <p class="m-0 p-0 text-start text-primary f-16 text-1-lines3"><?php echo $title ?? '' ?>
                                </p>

                            </div>
                            <div class="d-flex flex-row justify-content-end align-items-center gap-10">
                                <button type="button"
                                    class="btn btn-light rounded-12 px-8 py-2 f-14 text-nowrap shareLink"
                                    data-shareLink="<?php echo $surah_link ?? '#' ?>">
                                    <img src="<?php echo get_the_image_url('share.png') ?>" alt="share">
                                </button>
                                <a href="<?php echo aparat_video_link($link ?? '') ?>" download=""
                                    class="btn btn-light rounded-12 px-8 py-2 f-14 text-nowrap">
                                    <img src="<?php echo get_the_image_url('download.png') ?>" alt="download">
                                </a>
                            </div>
                        </div>
                        <div>
                            <video class="w-100 rounded" style="height: 300px !important;"
                                poster="<?php echo $image ?? '' ?>" controls preload="none" loading="lazy">
                                <source src="<?php echo aparat_video_link($link ?? '') ?>" type="video/mp4">
                                مرورگر شما از تگ video پشتیبانی نمی‌کند.
                            </video>
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
                            <a href="#" class="btn btn-outline-primary rounded-1 px-8 py-2 f-14 text-nowrap">ویدئو</a>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <script>

                    
class VideoFullscreenHandler {
    constructor() {
        this.init();
    }

    init() {
        const videos = document.querySelectorAll('video.w-100.rounded');

        videos.forEach(video => {
            // حذف کنترل‌های پیشفرض هنگام کلیک
            video.style.cursor = 'pointer';

            video.addEventListener('click', this.handleVideoClick.bind(this));
        });

        // مدیریت خروج از حالت تمام صفحه
        document.addEventListener('fullscreenchange', this.handleFullscreenChange.bind(this));
        document.addEventListener('webkitfullscreenchange', this.handleFullscreenChange.bind(this));
    }

    async handleVideoClick(e) {
        const video = e.target;

        if (document.fullscreenElement) return;

        try {
            // رفتن به حالت تمام صفحه
            await this.enterFullscreen(video);

            // پخش ویدیو پس از تمام صفحه
            setTimeout(() => {
                video.play();
            }, 500);

        } catch (error) {
            console.log('Fullscreen not available, playing normally');
            video.play();
        }
    }

    enterFullscreen(element) {
        if (element.requestFullscreen) {
            return element.requestFullscreen();
        } else if (element.webkitRequestFullscreen) {
            return element.webkitRequestFullscreen();
        } else if (element.mozRequestFullScreen) {
            return element.mozRequestFullScreen();
        } else if (element.msRequestFullscreen) {
            return element.msRequestFullscreen();
        }
    }

    handleFullscreenChange() {
        if (!document.fullscreenElement) {
            // وقتی از حالت تمام صفحه خارج شد
            const videos = document.querySelectorAll('video.w-100.rounded');
            videos.forEach(video => {
                video.pause();
            });
        }
    }
}

// راه‌اندازی هنگامی که DOM آماده است
document.addEventListener('DOMContentLoaded', () => {
    new VideoFullscreenHandler();
});
</script>