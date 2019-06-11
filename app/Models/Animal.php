<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $guarded = [];

    public function translations()
    {
    	return $this->hasMany(AnimalTranslation::class);
    }


    
}
