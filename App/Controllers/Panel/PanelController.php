<?php
namespace TAI\App\Controllers\Panel;

use Exception;
use TAI\App\Controllers\Controller;
use TAI\App\Services\Panel\PanelServices;

( defined( 'ABSPATH' ) ) || exit;

class PanelController extends Controller {

    protected $services;

    public function __construct() {

        $this->services = new PanelServices();

    }

    public function dashboard() {
        return $this->services->dashboard();
    }

    public function update( $request ) {
        return $this->services->update( $request );
    }

    public function getTeem() {
        return $this->services->getTeem( $_REQUEST );
    }

    public function addTeem( $request ) {
        return $this->services->addTeem( $_REQUEST );
    }

    public function updateTeem( $request ) {
        return $this->services->updateTeem( $_REQUEST );
    }

    public function artList() {
        return $this->services->artList( $_REQUEST );
    }

    public function artInfo() {
        return $this->services->artInfo();
    }

    public function logout() {

        wp_logout();
        wp_redirect(home_url("/panel"));
        exit;

    }

    public function sendArtInfo( $request, $file ) {

        try {

            $result = $this->services->sendArtInfo( $request, $file );

            return $this->success(
                $result[ 'massage' ],
                $result[ 'data' ] ?? null,

            );

        } catch ( Exception $exception ) {
            return $this->error(
                $exception->getMessage()
            );

        }

    }

}