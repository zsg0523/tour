<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['amount', 'price', 'rating', 'review', 'reviewed_at'];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;

    public function shopProduct()
    {
        return $this->belongsTo(ShopProduct::class);
    }

    public function shopProductSku()
    {
        return $this->belongsTo(ShopProductSku::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
