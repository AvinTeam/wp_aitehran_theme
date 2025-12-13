<?php
namespace TAI\App\Core;

(defined('ABSPATH')) || exit;

class Init
{

    public function __construct()
    {

        add_action('init', [ $this, 'init' ]);

    }

    /**
     * Fires after WordPress has finished loading but before any headers are sent.
     *
     */
    public function init(): void
    {
  

    }

  

}
