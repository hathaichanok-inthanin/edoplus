<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillConfirm extends Model
{
	protected $table = 'bill_confirms';

	protected $fillable = [
    	'member_id', 'bill', 'date'
    ];

    protected $primaryKey = 'id';
}
