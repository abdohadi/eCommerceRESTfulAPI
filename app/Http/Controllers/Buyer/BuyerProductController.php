<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $products = $buyer->transactions()
                          ->with('product')
                          ->get()
                          ->pluck('product');

        return $this->showAll(new ProductCollection(ProductResource::collection($products)));
    }
}
