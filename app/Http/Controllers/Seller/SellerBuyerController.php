<?php

namespace App\Http\Controllers\Seller;

use App\Buyer;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Buyer\BuyerCollection;

class SellerBuyerController extends ApiController
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
    public function index(Seller $seller)
    {
        $this->allowedAdminActions();
        
        $buyers = $seller->products()
                         ->whereHas('transactions')
                         ->with('transactions.buyer')
                         ->get()
                         ->pluck('transactions')
                         ->collapse()
                         ->pluck('buyer')
                         ->unique('id')
                         ->values();

        return $this->showAll(Buyer::resourceCollection($buyers));
    }
}
