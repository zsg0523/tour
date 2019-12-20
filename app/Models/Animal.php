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
        return $this->attributes['image_original'] = config('app.url') . "/uploads/" . $this->image;
    }

    // 中图
    public function getImageResizeAttribute($value)
    {
        return $this->attributes['image_resize'] = config('app.url') . "/uploads/" . substr($this->image, 0 , strpos($this->image, '.')) . "-resize.png";
    }

    // 缩略图
    public function getImageThumbnailAttribute($value)
    {
        return $this->attributes['image_resize'] = config('app.url') . "/uploads/" . substr($this->image, 0 , strpos($this->image, '.')) . "-thumbnail.png";
    }

    
    
}
