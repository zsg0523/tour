<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function attributes()
    {
    	return $this->belongsToMany(Attribute::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function orderItem()
    {
    	return $this->belongsTo(OrderItem::class);
    }
}
