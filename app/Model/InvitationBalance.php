<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvitationBalance extends Model
{
	protected $table = 'invitation_balances';

	protected $fillable = [
    	'member_id', 'type', 'balance', 'date', 'file'
    ];

    protected $primaryKey = 'id';
}
