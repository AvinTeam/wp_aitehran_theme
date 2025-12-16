<?php
namespace App\Core;

class Captcha {
    private $encryptionKey;
    private $cipher          = 'AES-256-CBC';
    private $expireInSeconds = 3600;

    public function __construct() {

        $this->encryptionKey = hash( 'sha256', config( 'app.key' ) . "super_secret-key" );
    }

    function base64UrlEncode( $data ) {
        return rtrim( strtr( base64_encode( $data ), '+/', '-_' ), '=' );
    }

    function base64UrlDecode( $data ) {
        $decoded = strtr( $data, '-_', '+/' );
        return base64_decode( $decoded );
    }

    public function encryptURL( $data ) {
        $iv             = openssl_random_pseudo_bytes( 16 );
        $expirationTime = time() + $this->expireInSeconds;
        $dataWithExpire = json_encode( array( 'data' => $data, 'expire' => $expirationTime ) );
        $encrypted      = openssl_encrypt( $dataWithExpire, $this->cipher, $this->encryptionKey, 0, $iv );
        $encryptedData  = $this->base64UrlEncode( $iv . $encrypted );

        return $encryptedData;
    }

    public function decryptURL( $encryptedString ) {

        $decoded = $this->base64UrlDecode( $encryptedString );

        if ( false === $decoded ) {
            die( 'Error: Decoding failed' );
        }

        $iv            = substr( $decoded, 0, 16 );
        $encryptedData = substr( $decoded, 16 );

        $decrypted = openssl_decrypt( $encryptedData, $this->cipher, $this->encryptionKey, 0, $iv );

        if ( false === $decrypted ) {
            return array( 'success' => false, 'error' => 'Decryption failed' );
        }

        $dataArray = json_decode( $decrypted, true );

        if ( time() > $dataArray[ 'expire' ] ) {
            return array( 'success' => false, 'error' => 'URL has expired' );
        }

        return array( 'success' => true, 'data' => $dataArray[ 'data' ] );
    }

    public function create_image() {

        $time = round( microtime( true ) * 1000 );

        $image = imagecreate( 200, 50 );

        $background_color = imagecolorallocate( $image, 255, 255, 255 );

        $text_color = imagecolorallocate( $image, 0, 0, 0 );

        $line_color = imagecolorallocate( $image, 0, 255, 0 );

        $pixel_color = imagecolorallocate( $image, 255, 0, 0 );

        imagefilledrectangle( $image, 0, 0, 200, 50, $background_color );

        for ( $i = 0; $i < 3; ++$i ) {
            imageline( $image, 0, rand( 0, 50 ), 200, rand( 0, 50 ), $line_color );
        }

        for ( $i = 0; $i < 1000; ++$i ) {
            imagesetpixel( $image, rand( 0, 200 ), rand( 0, 50 ), $pixel_color );
        }

        $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";

        $len = strlen( $letters );

        $word = "";

        $font = TAI_ASSETS . "fonts/arial.ttf";

        for ( $i = 0; $i < 6; ++$i ) {
            $letter = $letters[ rand( 0, $len - 1 ) ];

            imagettftext( $image, 20, rand( 20, 60 ), 25 + ( $i * 30 ), 30, $text_color, $font, $letter );

            $word = $word . $letter;
        }

        $array = glob( '*.png' );

        foreach ( $array as $x ) {
            $create_time = str_replace( '.png', '', $x );

            if ( $time - $create_time > 8000 ) {
                unlink( $x );
            }
        }

        imagepng( $image, $time . ".png" );

        return array(
            "key"      => $this->encryptURL( $word ),
            "fileName" => $time,

        );
    }
}
