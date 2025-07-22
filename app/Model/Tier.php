<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
	protected $table = 'tiers';

	protected $fillable = [
    	'tier', 'detail', 'min_price', 'max_price'
    ];

    protected $primaryKey = 'id';
}
