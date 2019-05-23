<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
   	protected $fillable = ['sort', 'image', 'file'];

   	public function book()
   	{
   		return $this->belongsTo(Book::class);
   	}

   	public function setImageAttribute($path)
    {
    	if ( ! starts_with($path, 'http') ) {
             // 拼接完整的url
             $path = config('app.url')."/uploads/images/contents/$path";
        }

        $this->attributes['image'] = $path;
    }

    public function setFileAttribute($path)
    {
    	if ( ! starts_with($path, 'http') ) {
             // 拼接完整的url
             $path = config('app.url')."/uploads/images/contents/$path";
        }

        $this->attributes['file'] = $path;
    }
}
