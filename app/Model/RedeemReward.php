<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RedeemReward extends Model
{
	protected $table = 'redeem_rewards';

	protected $fillable = [
    	'member_id', 'reward_id', 'point_id', 'date', 'status'
    ];

    protected $primaryKey = 'id';
}
