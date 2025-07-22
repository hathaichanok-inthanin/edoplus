<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountStore extends Authenticatable
{
	protected $table = 'account_stores';

	protected $fillable = [
    	'id', 'store_name', 'tel', 'username', 'password', 'branch', 'image'
    ];

    protected $primaryKey = 'id';
	
	protected $hidden = [
        'password', 'remember_token',
    ];
}