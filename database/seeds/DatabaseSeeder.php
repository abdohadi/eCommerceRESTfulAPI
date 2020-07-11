<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::flushEventListeners();
        Product::flushEventListeners();
        Category::flushEventListeners();
        Transaction::flushEventListeners();

        factory(User::class, 300)->create();
        $categories = factory(Category::class, 50)->create();
        factory(Product::class, 100)->create()->each(function($product) use ($categories) {
	        $product->categories()->attach($categories->random(rand(1, 5))->pluck('id'));
        });
        factory(Transaction::class, 100)->create();
    }
}
