<?php

    use TAI\App\Controllers\Ayeh\AyehController;
    use TAI\App\Controllers\Home\HomeController;
    add_filter( 'nav_menu_css_class', function ( $classes, $item, $args ) {

        if ( "/" . config( 'urls.campaigns' ) == $item->url ) {
            $classes[  ] = "current-menu-item";
            $classes[  ] = "active";
        }

        return $classes;
    }, 11, 3 );

    get_header();

    $controller     = new AyehController();
    $homeController = new HomeController();

    $controller->header();

?>
<div class="px-2 px-lg-0">
    <section class="container mt-40">
        <div class="row flex-row-reverse justify-content-between row-gap-4 row-gap-lg-0">


            <div class="col-12 col-lg-9 ">
                <?php
                $controller->description();
                $controller->sound();
                $controller->video();
                $controller->text_image();
                $controller->poster();
            ?>

            </div>


            <div class="col-12 col-lg-3 d-flex flex-column position-relative">

                <?php

                view( 'ayeh/single/sidebar', array(
                    'description' => $controller->getDescription,
                    'sound'       => $controller->getSound,
                    'video'       => $controller->getVideo,
                    'text_image'  => $controller->getTextImage,
                    'poster'      => $controller->getPoster,

                 )
                );
            ?>

            </div>

        </div>

        <?php
        $homeController->poster();
    ?>
    </section>
</div>

<button type="button"
    class="d-block d-lg-none btn bg-body rounded-circle px-8 py-2 f-14 text-nowrap position-fixed z-3 shareLink"
    data-shareLink="<?php echo get_the_permalink() ?>" style="right: 20px; bottom: 33px;">
    <img src="<?php echo get_the_image_url( 'share.png' ) ?>" class="w-32 h-32 object-fit-cover" alt="share">
</button>

<button type="button"
    class=" d-block d-lg-none btn bg-body rounded-circle px-8 py-2 f-14 text-nowrap position-fixed z-3 go-to-top"
    style="left: 20px; bottom: 33px;">
    <img src="<?php echo get_the_image_url( 'arrow-up.png' ) ?>" class="w-32 h-32 object-fit-cover" alt="go to top">
</button>


<script>
document.querySelectorAll('.block-list button ').forEach(item => {
    item.addEventListener('click', function() {
        const dataBlock = this.getAttribute('data-block');
        document.querySelectorAll('.block-list button ').forEach(el => {
            el.classList.remove('active');
        });
        this.classList.add('active');
        const mapSection = document.getElementById(dataBlock);
        mapSection.scrollIntoView({
            behavior: 'smooth'
        });
    });
});

let goToTopButtons = document.querySelectorAll('.go-to-top');
goToTopButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});


const sections = document.querySelectorAll("section");

let id = 'description';

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {

            let newId = entry.target.id;

            if (newId != "" && newId != id) {
                id = newId;
            }
            const items = document.querySelectorAll(".block-list button");
            if (items) {
                items.forEach(item => {
                    item.classList.remove("active");
                    if (item.getAttribute('data-block') === id) {
                        item.classList.add('active');
                    }

                });
            }
        }
    });
}, {
    threshold: 0.5
});

sections.forEach(section => observer.observe(section));
</script>






<?php

get_footer();