<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Seller\SellerCollection;

class BuyerSellerController extends ApiController
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
    public function index(Buyer $buyer)
    {
        $this->allowedAdminActions();
        
        $sellers = $buyer->transactions()
                         ->with('product.seller')
                         ->get()
                         ->pluck('product.seller')
                         ->unique()
                         ->values();

        return $this->showAll(Seller::resourceCollection($sellers));
    }
}
