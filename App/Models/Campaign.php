<?php
namespace TAI\App\Models;

use TAI\App\Core\DB\DB;
use TAI\App\Core\DB\Model;
use TAI\App\Core\DB\QueryBuilder;

(defined('ABSPATH')) || exit;

class Campaign extends Model
{
    protected $fillable   = [ 'term_id', 'name', 'slug' ];
    protected $table      = 'wp_terms';
    protected $primaryKey = 'term_id';

    public function gifts(): QueryBuilder
    {

        return $this->belongsToMany(
            Gifts::class,
            'gift_campaign',
            'campaign_id',
            'gift_id',
            'id'
        );

    }

}
