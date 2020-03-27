<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $guarded = [];

    public function themes_translations()
    {
    	return $this->hasMany(ThemesTranslation::class);
    }
}
