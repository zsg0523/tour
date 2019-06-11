<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $guarded = [];

    public function animal_translations()
    {
    	return $this->hasMany(AnimalTranslation::class);
    }
}
