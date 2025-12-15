<?php
namespace TAI\App\Models;

use TAI\App\Core\DB\Model;

( defined( 'ABSPATH' ) ) || exit;

class Contact extends Model {
    protected $fillable = array( 'first_name', 'last_name', 'mobile', 'description', 'status' );

}
