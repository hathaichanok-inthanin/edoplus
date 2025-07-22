<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
	protected $table = 'points';

	protected $fillable = [
    	'member_id', 'branch_id', 'admin_id','staff_id', 'store_id', 'type', 'bill_number', 'date', 'price', 'file'
    ];

    protected $primaryKey = 'id';
}
