<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class Member extends Authenticatable 
{
    use Notifiable, Sortable;
    protected $table = 'members';

    protected $guard = 'member';


    protected $fillable = [
        'card_id', 'title', 'name', 'surname', 'bday', 'tel', 'date', 'password', 'status',
    ];

    public $sortable = ['id', 'card_id', 'title', 'name', 'surname', 'bday', 'tel', 'date', 'password', 'status', 'invitation', 'created_at', 'updated_at'];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
