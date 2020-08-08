<?php

namespace App\Http\Controllers\Product;

use App\Buyer;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Buyer\BuyerCollection;

class ProductBuyerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $this->allowedAdminActions();
        
        $buyers = $product->transactions()
                          ->with('buyer')
                          ->get()
                          ->pluck('buyer')
                          ->unique()
                          ->values();

        return $this->showAll(Buyer::resourceCollection($buyers));
    }
}
