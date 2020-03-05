<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopProduct;
use Faker\Generator as Faker;

$factory->define(ShopProduct::class, function (Faker $faker) {
    $image = $faker->randomElement([
        "https://www.wennoanimal.com/uploads/images/s12_piece_WPZ0201.jpg",
        "https://www.wennoanimal.com/uploads/images/s12_piece_WPZ0202.jpg",
        "https://www.wennoanimal.com/uploads/images/s12_piece_WPZ0203.jpg",
        "https://www.wennoanimal.com/uploads/images/s12_piece_WPZ0204.jpg",
        "https://www.wennoanimal.com/uploads/images/s12_piece_WPZ0205.jpg",
        "https://www.wennoanimal.com/uploads/images/s12_piece_WPZ0206.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0101.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0102.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0103.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0104.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0105.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0106.jpg",
        "https://www.wennoanimal.com/uploads/images/s4_piece_WPZ0107.jpg"
    ]);

    return [
        // 'title'        => $faker->word,
        'title' => '商品名称',
        'description'  => '商品描述',
        'image'        => $image,
        'on_sale'      => true,
        'rating'       => $faker->numberBetween(0, 5),
        'sold_count'   => $faker->numberBetween(0, 999),
        'review_count' => $faker->numberBetween(0, 999),
        'price'        => 0,
    ];

});
