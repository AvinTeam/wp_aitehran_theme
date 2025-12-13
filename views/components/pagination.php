<section class="container mt-40 p-16 d-flex flex-row justify-content-center pagination ">
    <div class="col col-7 d-flex flex-column flex-lg-row justify-content-between align-items-center row-gap-lg-0 row-gap-3">

        <?php if (empty($prev_btn[ 'action' ])): ?>
        <a href="<?php echo $prev_btn[ 'link' ] ?>" class="bg-media text-primary rounded-circle py-12 px-24">
            <i class="bi bi-chevron-right"></i>
            <span>قبلی</span>
        </a>

        <?php else: ?>

        <span href="" class="bg-media text-primary rounded-circle py-12 px-24">
            <i class="bi bi-chevron-right"></i>
            <span>قبلی</span>
        </span>
        <?php endif; ?>

        <div class="d-flex flex-row-reverse justify-content-center  align-items-center gap-16 flex-wrap">

            <?php foreach ($pages as $item): ?>
            <a href="<?php echo $item[ 'link' ] ?>"
                class="bg-media text-primary rounded-circle w-45 h-45 d-flex justify-content-center align-items-center                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $item[ 'action' ] ?>">
                <span><?php echo $item[ 'name' ] ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <?php if (empty($next_btn[ 'action' ])): ?>
        <a href="<?php echo $next_btn[ 'link' ] ?>" class="bg-media text-primary rounded-circle py-12 px-24">
            <span>بعدی</span>
            <i class="bi bi-chevron-left"></i>
        </a>
        <?php else: ?>
        <span class="bg-media text-primary rounded-circle py-12 px-24">
            <span>بعدی</span>
            <i class="bi bi-chevron-left"></i>
        </span>
        <?php endif; ?>
    </div>
</section>