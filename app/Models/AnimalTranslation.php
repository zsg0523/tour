<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalTranslation extends Model
{
    protected $guarded = [];

    protected $table = 'animals_translations';

    public function animal()
    {
    	return $this->belongsTo(Animal::class);
    }

    public function sound()
    {
    	return $this->belongsTo(Sound::class);
    }
}