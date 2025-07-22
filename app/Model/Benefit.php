<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
	protected $table = 'benefits';

	protected $fillable = [
    	'name', 'detail', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
