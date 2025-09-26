<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpecialmemberBalance extends Model
{
	protected $table = 'specialmember_balances';

	protected $fillable = [
    	'branch_id', 'admin_id', 'staff_id', 'store_id', 'member_id', 'bill_number', 'type', 'balance', 'date', 'service_date', 'file'
    ];

    protected $primaryKey = 'id';
}
