<?php

namespace Tests\Feature;

use App\Seller;
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
        $this->withoutExceptionHandling();
        $categories = $this->get('api/sellers/5/categories/');

        dd($categories);
    }
}
