<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
	protected $table = 'reward_points';

	protected $fillable = [
    	'reward_id', 'point', 'date'
    ];

    protected $primaryKey = 'id';
}
