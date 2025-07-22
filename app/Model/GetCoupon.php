<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GetCoupon extends Model
{
	protected $table = 'get_coupons';

	protected $fillable = [
    	'member_id', 'coupon_id', 'date_get_coupon', 'date_use_coupon', 'status'
    ];

    protected $primaryKey = 'id';
}
