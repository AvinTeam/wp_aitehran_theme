<?php
namespace TAI\App\Models;

use TAI\App\Core\DB\Model;

( defined( 'ABSPATH' ) ) || exit;

class Groups extends Model {
    protected $fillable = array( 'id', 'user_id', 'province_id', 'city_id', 'area_id' );

}