<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopProductSku;
use Faker\Generator as Faker;

$factory->define(ShopProductSku::class, function (Faker $faker) {
    return [
        'title'       => $faker->word,
        'description' => $faker->sentence,
        'price'       => $faker->randomNumber(4),
        'stock'       => $faker->randomNumber(5),
    ];

});
