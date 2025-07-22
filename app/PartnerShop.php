<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PartnerShop extends Authenticatable
{
	protected $table = 'partner_shops';

	protected $fillable = [
    	'name', 'tel', 'password', 'type', 'status', 'image', 'branch'
    ];

    protected $primaryKey = 'id';
	
	protected $hidden = [
        'password', 'remember_token',
    ];
}