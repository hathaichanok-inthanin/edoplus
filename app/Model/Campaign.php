<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
	protected $table = 'campaigns';

	protected $fillable = [
    	'code', 'name', 'start_date', 'expire_date','detail', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
