<?php
namespace TAI\App\Options;

use TAI\App\Core\Options;

( defined( 'ABSPATH' ) ) || exit;

class SMSSetting extends Options {

    private static $arrayKey = "sms";

    public static function get() {
        $sms = self::getter();
        return $sms[ self::$arrayKey ] ?? array();
    }

    public static function set( array $input ) {

        $sms[ self::$arrayKey ] = $input;
        return self::setter( $sms );
    }

    public static function getToken() {

        $option = self::getter();

        return $option[ self::$arrayKey ][ 'token' ] ?? "";

    }

    public static function getOTP() {

        $option = self::getter();

        $otp = $option[ self::$arrayKey ][ 'otp' ] ?? array();

        return array(
            "templateID" => $otp[ "templateID" ] ?? "",
            "code"       => $otp[ "code" ] ?? "",
        );
    }

    public static function getRegister() {

        $option = self::getter();

        $otp = $option[ self::$arrayKey ][ 'register' ] ?? array();

        return array(
            "templateID" => $otp[ "templateID" ] ?? "",
            "fullname"   => $otp[ "fullname" ] ?? "",
        );
    }

    public static function getArt() {

        $option = self::getter();

        $otp = $option[ self::$arrayKey ][ 'art' ] ?? array();

        return array(
            "templateID"   => $otp[ "templateID" ] ?? "",
            "fullname"     => $otp[ "fullname" ] ?? "",
            "artName"      => $otp[ "artName" ] ?? "",
            "trackingCode" => $otp[ "trackingCode" ] ?? "",
        );
    }
}
