<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $product = factory(Product::class)->create();

        dd($product->seller);
    }
}
