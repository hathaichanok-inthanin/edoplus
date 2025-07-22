<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'articles';

	protected $fillable = [
    	'title', 'type', 'article', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
