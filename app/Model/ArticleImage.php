<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
	protected $table = 'article_images';

	protected $fillable = [
    	'image'
    ];
          
    protected $primaryKey = 'id';
}
