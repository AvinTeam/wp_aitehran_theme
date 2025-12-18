<div class=" bg-gray d-flex flex-column justify-content-center align-items-center rounded-65  px-40 py-24">


    <div class="bg-secondary rounded-32 w-100 text-white text-center p-16 mb-4 fw-bold f-24">
        آخرین اخبار
    </div>

    <div class="w-100 d-flex flex-column justify-content-center align-items-center row-gap-3">

        <?php foreach ( $sidebarItems as $sidebarItem ):?>

        <div class="w-100 d-flex flex-column justify-content-center align-items-center row-gap-3 bg-primary p-10">
            <a href="<?php echo $sidebarItem[ 'link' ] ?>"> <img src="<?php echo $sidebarItem[ 'image' ] ?>"
                    alt="<?php echo $sidebarItem[ 'title' ] ?>" class="w-100 h-120 object-fit-cover"> </a>
            <a href="<?php echo $sidebarItem[ 'link' ] ?>"
                class="btn btn-link f-20 fw-bold "><?php echo $sidebarItem[ 'title' ]??"5555" ?></a>
        </div>
        <?php endforeach; ?>
    </div>




</div>