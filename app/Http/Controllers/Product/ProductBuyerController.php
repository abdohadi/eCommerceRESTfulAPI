<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Buyer\BuyerCollection;

class ProductBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $buyers = $product->transactions()
                          ->with('buyer')
                          ->get()
                          ->pluck('buyer')
                          ->unique()
                          ->values();

        return $this->showAll(new BuyerCollection(BuyerResource::collection($buyers)));
    }
}
