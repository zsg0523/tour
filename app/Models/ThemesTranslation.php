<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemesTranslation extends Model
{
    protected $guarded = [];

    /** [getTitlePageAttribute 清除title_page的字符] */
    public function getTitlePageAttribute($value)
    {
    	return trim($value);
    }

    public function theme()
    {
    	return $this->belongsTo(Theme::class);
    }
}
