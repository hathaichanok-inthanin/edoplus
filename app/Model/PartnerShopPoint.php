<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartnerShopPoint extends Model
{
	protected $table = 'partner_shop_points';

	protected $fillable = [
    	'partner_id', 'point', 'date'
    ];

    protected $primaryKey = 'id';
}
