<section class="container mt-40">


    <div class="row row-cols-1 row-cols-lg-2">
        <div class="d-flex flex-column justify-content-center align-items-start">

            <span class="f-32 fw-black text-primary mb-24"><?php echo $title ?></span>
            <span class="f-20 text-primary-emphasis text-justify mb-40"><?php echo $description ?></span>
            <a href="tel:<?php echo $phone ?>" target="_blank"
                class="btn btn-primary rounded-circle px-24 py-12">تماس با پشتیبانی</a>

            <div class=" d-none d-lg-flex justify-content-center align-items-center w-100 mt-16">
                <img class="img-fluid" src="<?php echo get_the_image_url('faq.png') ?>">
            </div>
        </div>
        <div class="my-3">

            <div class="accordion accordion-flush" id="accordionFlushFAQ">

                <?php foreach ($faqs as $key => $value): ?>
                <div class="accordion-item mb-16">
                    <h2 class="accordion-header  shadow rounded-12 overflow-hidden">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse-<?php echo $key ?>" aria-expanded="false"
                            aria-controls="flush-collapse-<?php echo $key ?>">
                            <?php echo $value[ 'question' ] ?>
                        </button>
                    </h2>
                    <div id="flush-collapse-<?php echo $key ?>" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushFAQ">
                        <div class="accordion-body"><?php echo do_shortcode($value[ 'answer' ]) ?></div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>














        </div>

    </div>

























</section>