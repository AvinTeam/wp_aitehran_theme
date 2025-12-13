<div class="d-flex flex-row justify-content-between align-items-center">
    <a class="btn_my_test" data-clipboard-target="#copyLinkTextarea">
        <img class="w-32 h-32 link-icon" src="<?php echo get_the_image_url('share/copy.png') ?>">
    </a>

    <a id="linkedin" href="https://www.linkedin.com/cws/share?url=<?php echo $link ?? '' ?>">
        <img class="w-32 h-32" src="<?php echo get_the_image_url('share/linkedin.png') ?>">
    </a>
    <a id="telegram" href="tg://msg_url?url=<?php echo $link ?? '' ?>">
        <img class="w-32 h-32" src="<?php echo get_the_image_url('share/telegram.png') ?>">
    </a>
    <a id="bale" href="https://ble.ir/share/url?url=<?php echo $link ?? '' ?>">
        <img class="w-32 h-32" src="<?php echo get_the_image_url('share/bale.png') ?>">
    </a>
    <a id="eitaa" href="https://www.eitaa.com/share/url?url=<?php echo $link ?? '' ?>">
        <img class="w-32 h-32" src="<?php echo get_the_image_url('share/eitaa.png') ?>">
    </a>
</div>
<textarea id="copyLinkTextarea" class="opacity-0" style="width: 0px; height: 0px;"><?php echo $link ?? '' ?></textarea>