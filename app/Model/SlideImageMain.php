<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SlideImageMain extends Model
{
	protected $table = 'slide_image_mains';

	protected $fillable = [
    	'image', 'status'
    ];

    protected $primaryKey = 'id';
}
