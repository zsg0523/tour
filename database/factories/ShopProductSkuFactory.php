<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopProductSku;
use Faker\Generator as Faker;

$factory->define(ShopProductSku::class, function (Faker $faker) {
    return [
        'title'       => 'SKU名称',
        'description' => 'SKU描述',
        'price'       => $faker->randomNumber(4),
        'stock'       => $faker->randomNumber(5),
    ];

});
