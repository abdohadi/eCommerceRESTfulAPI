<?php

namespace App\Http\Controllers\Category;

use App\Buyer;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Buyer\BuyerCollection;

class CategoryBuyerController extends ApiController
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
    public function index(Category $category)
    {
        $this->allowedAdminActions();
        
        $buyers = $category->products()
                           ->whereHas('transactions')
                           ->with('transactions.buyer')
                           ->get()
                           ->pluck('transactions')
                           ->collapse()
                           ->pluck('buyer')
                           ->unique()
                           ->values();

        return $this->showAll(Buyer::resourceCollection($buyers));
    }
}
