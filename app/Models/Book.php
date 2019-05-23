<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'introduction', 'cover', 'map', 'is_release', 'created_userid'];

    public function contents()
    {
    	return $this->hasMany(BookContent::class);
    }


    /** [setImageAttribute 后台上传图片需补齐地址] */
    public function setCoverAttribute($path)
    {
    	if ( ! starts_with($path, 'http') ) {
             // 拼接完整的url
             $path = config('app.url')."/uploads/images/covers/$path";
        }

        $this->attributes['cover'] = $path;
    }


    public function setMapAttribute($path)
    {
    	if ( ! starts_with($path, 'http') ) {
             // 拼接完整的url
             $path = config('app.url')."/uploads/images/covers/$path";
        }

        $this->attributes['map'] = $path;
    }
}
