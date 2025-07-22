<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountStaff extends Authenticatable
{
	protected $table = 'account_staffs';

	protected $fillable = [
    	'id', 'store_id', 'position', 'name', 'username', 'password', 'password_name', 'status'
    ];

    protected $primaryKey = 'id';
	
	protected $hidden = [
        'password', 'remember_token',
    ];
} 