<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $unguard = [];

    protected $table = 'medias';

    /** [getMediaAttribute 设置路径] */
    public function getMediaAttribute($value)
    {	
    	return url('/uploads/' . $value);
    }
}
