<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Product;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $product = Product::all()->random();
    $buyer = User::all()->except($product->seller->id)->random();

    return [
        'buyer_id' => $buyer->id,
        'product_id' => $product->id,
        'quantity' => $quantity = $faker->randomDigit,
        'total_price' => $product->price * $quantity
    ];
});
