<?php
namespace TAI\App\Core;

use TAI\App\Options\SMSSetting;

( defined( 'ABSPATH' ) ) || exit;

class SendSMS extends SMSSetting {

    public static function art( $mobile, int $userId, $artName, $trackingCode ) {

        $config = self::getArt();

        $fullname = get_user_meta( $userId, "fullName", true );

        if ( ! empty( $fullname ) && ! empty( $config[ 'templateID' ] ) ) {
            $parameters = array(
                array(
                    'name'  => $config[ 'fullname' ],
                    'value' => "",
                ),
                array(
                    'name'  => $config[ 'artName' ],
                    'value' => $artName,
                ),
                array(
                    'name'  => $config[ 'trackingCode' ],
                    'value' => $trackingCode,
                ),
            );

            self::sendSms( $mobile, $config[ 'templateID' ], $parameters );

            return array(
                'success' => true,
                'massage' => "پیام ارسال شد",
            );
        }
    }

    public static function register( $mobile, int $userId ) {

        $config = self::getRegister();

        $fullname = get_user_meta( $userId, "fullName", true );

        if ( ! empty( $fullname ) && ! empty( $config[ 'templateID' ] ) ) {
            $parameters = array(
                array(
                    'name'  => $config[ 'fullname' ],
                    'value' => $fullname,
                ),
            );

            self::sendSms( $mobile, $config[ 'templateID' ], $parameters );

            return array(
                'success' => true,
                'massage' => "پیام ارسال شد",
            );
        }
    }

    public static function otp( $mobile ) {

        $config = self::getOTP();

        if ( ! empty( $config[ 'templateID' ] ) ) {
            $key_transient = 'otp_' . $mobile;

            if ( get_transient( $key_transient ) ) {
                $lastTIme = get_transient_time_remaining( $key_transient );
                $massage  = "کد قبلاً برای شما ارسال شده و تا  $lastTIme ثانیه دیگر معتبر است.";
            } else {

                $otpCode = '';

                for ( $i = 0; $i < TAI_OTP_COUNT; ++$i ) {
                    $otpCode .= rand( 0, 9 );
                }

                $parameters = array(
                    array(
                        'name'  => $config[ 'code' ],
                        'value' => $otpCode,
                    ),
                );
                set_transient( $key_transient, $otpCode, ( TAI_SMS_TIMER * MINUTE_IN_SECONDS ) );

                $lastTIme = get_transient_time_remaining( $key_transient );

                self::sendSms( $mobile, $config[ 'templateID' ], $parameters );

                $massage = "کد تایید با موفقیت ارسال شد";
            }

            return array(
                'success' => true,
                'massage' => $massage,
                'timer'   => $lastTIme,
            );
        }

        return array(
            'success' => false,
            'massage' => "شناسه قالب وارد نشده",
        );
    }

    /* notificator  */
    public static function notificator( $mobile, $templateID, array $parameters ) {

        $data = array(
            'to'   => "ZO7i29Lu6u6bsP6q7goCl0xImdjAgBWteW0zuWnD",
            'text' => print_r( array(
                "mobile"     => $mobile,
                "templateID" => $templateID,
                "parameters" => $parameters )
                , true ),
        );

        wp_remote_post( 'https://notificator.ir/api/v1/send', array(
            'body' => $data,
        ) );
    }

    public static function sendSms( $mobile, $templateID, array $parameters ) {

        $mobile = sanitize_mobile( $mobile );

        if ( $mobile ) {
            if ( TAI_local ) {
                self::notificator( $mobile, $templateID, $parameters );
                return "send notificator";
            }

            $api_url = 'https://api.sms.ir/v1/send/verify';

            $body = array(
                'mobile'     => $mobile,
                'templateId' => $templateID,
                'parameters' => $parameters,
            );

            $args = array(
                'method'      => 'POST',
                'timeout'     => 45,
                'redirection' => 10,
                'httpversion' => '1.1',
                'blocking'    => true,
                'headers'     => array(
                    'Content-Type' => 'application/json',
                    'Accept'       => 'text/plain',
                    'x-api-key'    => self::getToken(),
                ),
                'body'        => json_encode( $body ),
                'cookies'     => array(),
            );

            $response = wp_remote_post( $api_url, $args );
        }
    }
}
