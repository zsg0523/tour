<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];

    public function button()
    {
    	return $this->hasOne(Button::class);
    }
}
