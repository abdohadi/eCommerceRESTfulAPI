<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Buyer;
use App\Product;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $product = Product::all()->random();
    $buyer = User::all()->except($product->seller->id)->random();

    return [
        'buyer_id' => $buyer,
        'product_id' => $product,
        'quantity' => $quantity = $faker->randomeDigit,
        'total_price' => $product->price * $quantity
    ];
});
