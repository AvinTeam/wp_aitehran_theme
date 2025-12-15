<?php
namespace TAI\App\Models;

use TAI\App\Core\DB\Model;

( defined( 'ABSPATH' ) ) || exit;

class Contact extends Model {
    protected $fillable = array( 'id', 'first_name', 'last_name', 'mobile', 'description', 'status', 'created_at', 'updated_at' );

    public static function allStatusCount( $status = null ) {

        $allContact = Contact::all();

        if ( $status ) {
            $allContact = $allContact->where( "status", $status );
        }

        return numberCount( $allContact->count() );
    }
}
