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

    /** [setImageAttribute 后台上传图片需补齐地址] */
    public function setImageAttribute($path)
    {
    	if ( ! starts_with($path, 'http') ) {
             // 拼接完整的url
             $original_path = config('app.url')."/uploads/animals/original/$path";
             $resize_path = config('app.url')."/uploads/animals/resize/$path";
             $thumbnail_path = config('app.url')."/uploads/animals/thumbnail/$path";
        }

        // $this->attributes['image'] = $original_path;
        // $this->attributes['image_resize'] = $resize_path;
        // $this->attributes['image_thumbnail'] = $thumbnail_path;
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
