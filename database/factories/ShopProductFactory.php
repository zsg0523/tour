<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopProduct;
use Faker\Generator as Faker;

$factory->define(ShopProduct::class, function (Faker $faker) {
    $image = $faker->randomElement([
        "images/s12_piece_WPZ0201.jpg",
        "images/s12_piece_WPZ0202.jpg",
        "images/s12_piece_WPZ0203.jpg",
        "images/s12_piece_WPZ0204.jpg",
        "images/s12_piece_WPZ0205.jpg",
        "images/s12_piece_WPZ0206.jpg",
        "images/s4_piece_WPZ0101.jpg",
        "images/s4_piece_WPZ0102.jpg",
        "images/s4_piece_WPZ0103.jpg",
        "images/s4_piece_WPZ0104.jpg",
        "images/s4_piece_WPZ0105.jpg",
        "images/s4_piece_WPZ0106.jpg",
        "images/s4_piece_WPZ0107.jpg"
    ]);

    // 从数据库中随机取一个类目
    $shop_category = \App\Models\ShopCategory::query()->where('is_directory', false)->inRandomOrder()->first();

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
        'shop_category_id'  => $shop_category ? $shop_category->id : null,
    ];

});
