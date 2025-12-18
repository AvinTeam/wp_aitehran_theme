<?php
namespace TAI\App\Core\Traits;

( defined( 'ABSPATH' ) ) || exit;

trait ReturnMessageTrait {

    protected function success( string $massage, array | string | null $data = null ) {

        return (object) array(
            "massage" => $massage,
            "result"  => $data,
            "success" => true,
         );
    }

    protected function error( string $massage, array | string | null $data = null ) {

        return (object) array(
            "massage" => $massage,
            "result"  => $data,
            "success" => false,

         );
    }

}
