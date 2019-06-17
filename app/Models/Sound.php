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

    public function getPathAttribute($value)
    {
       return $this->attributes['path'] = config('app.url') . "/uploads/sound_animal/{$this->lang}/{$this->name}.{$this->type}";
    }
}
