<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Seller\SellerCollection;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()
                         ->with('product.seller')
                         ->get()
                         ->pluck('product.seller')
                         ->unique()
                         ->values();

        return $this->showAll(new SellerCollection(SellerResource::collection($sellers)));
    }
}
