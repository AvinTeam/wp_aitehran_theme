<?php
namespace TAI\App\Models;

use TAI\App\Core\DB\Model;

( defined( 'ABSPATH' ) ) || exit;

class Iran extends Model {
    protected $fillable = array( 'id', 'name', 'province_id' );

    public static function allStatusCount( $status = null ) {

        $allContact = Contact::all();

        if ( $status ) {
            $allContact = $allContact->where( "status", $status );
        }

        return numberCount( $allContact->count() );
    }
}
