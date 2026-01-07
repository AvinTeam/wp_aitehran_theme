<section class="w-100 bg-gray rounded-65 pt-100 px-40 pb-40 ">


    <?php  if(!empty($video[ 'link' ])):?>

    <video class="w-100 rounded" style="height: 300px !important; cursor: pointer;"
        poster="<?php echo $video[ 'poster' ] ?>" controls="" preload="none" muted
        loading="lazy">
        <source
            src="<?php echo $video[ 'link' ] ?>"
            type="video/mp4">
        مرورگر شما از تگ video پشتیبانی نمی‌کند.
    </video>

    <?php  else :?>
    <img src="<?php echo post_image_url() ?>" alt="<?php the_title(); ?>" class="w-100 object-fit-cover"
        style="max-height: 480px;">

    <?php  endif; ?>


    <h1 class="f-52 text-justify text-primary my-2"><?php the_title(); ?></h1>

    <div class="f-24 fw-light text-justify mt-32 text-primary">
        <?php the_content(); ?>
    </div>
</section>