<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
    	'seller_id' => User::all()->random(),
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'quantity' => $faker->numberBetween(1, 100),
        'price' => $faker->numberBetween(10, 1000),
        'image' => $faker->image('public/storage/images',640,480, null, false),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT])
    ];
});
