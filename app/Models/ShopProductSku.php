<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductSku extends Model
{
    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function shopProduct()
    {
        return $this->belongsTo(ShopProduct::class);
    }
}
