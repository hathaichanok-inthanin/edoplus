<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartnerShopPromotion extends Model
{
	protected $table = 'partner_shop_promotions';

	protected $fillable = [
    	'partner_id', 'promotion', 'status', 'image'
    ];

    protected $primaryKey = 'id';
}
