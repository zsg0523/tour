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

    // 原图
    public function getImageOriginalAttribute($value)
    {
        return $this->attributes['image_original'] = config('app.url')."/uploads/animals/original/{$this->image}";
    }

    // 中图
    public function getImageResizeAttribute($value)
    {
        return $this->attributes['image_resize'] = config('app.url')."/uploads/animals/resize/{$this->image}";
    }

    // 缩略图
    public function getImageThumbnailAttribute($value)
    {
        return $this->attributes['image_thumbnail'] = config('app.url')."/uploads/animals/thumbnail/{$this->image}";
    }

    
    
}
