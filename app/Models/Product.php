<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $unguard = [];

    public function attributes()
    {
    	return $this->belongsToMany(Attribute::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
