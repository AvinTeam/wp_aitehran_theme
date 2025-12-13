<?php
namespace TAI\App\Core;

(defined('ABSPATH')) || exit;

class Styles
{

    private $style_dep      = [  ];
    private $javascript_dep = [ 'jquery' ];

    public function __construct()
    {

        add_action('admin_enqueue_scripts', [ $this, 'admin_script' ]);

        add_action('wp_enqueue_scripts', [ $this, 'public_style' ]);

    }

    public function admin_script()
    {
        wp_enqueue_media();

        $this->jalalidatepicker();
        $this->select2();
        $this->custom();

        wp_enqueue_style(
            'tai_admin',
            TAI_CSS . 'admin.css',
            $this->style_dep,
            TAI_VERSION
        );

        wp_enqueue_script(
            'tai_admin',
            TAI_JS . 'admin.js',
            $this->javascript_dep,
            TAI_VERSION,
            true
        );

        wp_localize_script(
            'tai_admin',
            'tai_js',
            [
                'ajaxurl'  => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('ajax-nonce'),
                'socials'  => config('app.socials', [  ]),
                'appLinks' => config('app.appLinks', [  ]),
             ]
        );

    }

    public function public_style()
    {
        $this->bootstrap();
        $this->select2();
        $this->lightbox();
        $this->jalalidatepicker();
        $this->swiper();
        $this->clipboard();

        wp_enqueue_style(
            'tai_style',
            TAI_CSS . 'public.css',
            $this->style_dep,
            TAI_VERSION
        );

        wp_enqueue_script(
            'tai_js',
            TAI_JS . 'public.js',
            $this->javascript_dep,
            TAI_VERSION,
            true
        );
        wp_enqueue_script(
            'tai_search_js',
            TAI_JS . 'search.js',
            [ 'jquery' ],
            TAI_VERSION,
            true
        );

        wp_localize_script(
            'tai_js',
            'tai_js',
            [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('ajax-nonce' . tai_cookie()),
                'clock'   => get_option('tai_clock'),
             ]
        );

    }

    private function bootstrap()
    {

        $this->style_dep[  ]      = 'bootstrap.icons';
        $this->javascript_dep[  ] = 'bootstrap';

        wp_register_style(
            'bootstrap.rtl',
            TAI_VENDOR . 'bootstrap/bootstrap.rtl.min.css',
            [  ],
            '5.3.7'
        );
        wp_register_style(
            'bootstrap.icons',
            TAI_VENDOR . 'bootstrap/bootstrap-icons.min.css',
            [ 'bootstrap.rtl' ],
            '1.13.1'
        );
        wp_register_script(
            'bootstrap',
            TAI_VENDOR . 'bootstrap/bootstrap.min.js',
            [  ],
            '5.3.7',
            true
        );

    }

    private function select2()
    {

        $this->style_dep[  ] = $this->javascript_dep[  ] = 'select2';

        wp_register_style(
            'select2',
            TAI_VENDOR . 'select2/select2.min.css',
            [  ],
            '4.1.0-rc.0'
        );
        wp_register_script(
            'select2',
            TAI_VENDOR . 'select2/select2.min.js',
            [  ],
            '4.1.0-rc.0',
            true
        );

    }

    private function jalalidatepicker()
    {

        $this->style_dep[  ] = $this->javascript_dep[  ] = 'jalalidatepicker';

        wp_register_style(
            'jalalidatepicker',
            TAI_VENDOR . 'jalalidatepicker/jalalidatepicker.min.css',
            [  ],
            '0.9.6'
        );
        wp_register_script(
            'jalalidatepicker',
            TAI_VENDOR . 'jalalidatepicker/jalalidatepicker.min.js',
            [  ],
            '0.9.6',
            true
        );

    }

    private function swiper()
    {
        $this->style_dep[  ] = $this->javascript_dep[  ] = 'swiper';

        wp_register_style(
            'swiper',
            TAI_VENDOR . 'swiper/swiper-bundle.min.css',
            [  ],
            '11.2.2',
        );

        wp_register_script(
            'swiper',
            TAI_VENDOR . 'swiper/swiper-bundle.min.js',
            [  ],
            '11.2.2',

        );

    }

    private function lightbox()
    {
        $this->style_dep[  ] = $this->javascript_dep[  ] = 'lightbox';

        wp_register_style(
            'lightbox',
            TAI_VENDOR . 'lightbox/lightbox.min.css',
            [  ],
            '2.11.3',
        );

        wp_register_script(
            'lightbox',
            TAI_VENDOR . 'lightbox/lightbox.min.js',
            [  ],
            '2.11.3',

        );

    }

    private function clipboard()
    {
        $this->javascript_dep[  ] = 'clipboard';

        wp_register_script(
            'clipboard',
            TAI_VENDOR . 'clipboard/clipboard.min.js',
            [  ],
            '2.0.11',
        );

    }

    private function custom()
    {
        $this->style_dep[  ] = $this->javascript_dep[  ] = 'custom';

        wp_register_style(
            'custom',
            TAI_VENDOR . 'custom/custom.css',
            [  ],
            '1.0.0',
        );

        wp_register_script(
            'custom',
            TAI_VENDOR . 'custom/custom.js',
            [ 'jquery' ],
            '1.0.0',

        );

    }

}
