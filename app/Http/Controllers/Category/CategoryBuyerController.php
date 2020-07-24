<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Buyer\BuyerCollection;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $buyers = $category->products()
                           ->whereHas('transactions')
                           ->with('transactions.buyer')
                           ->get()
                           ->pluck('transactions')
                           ->collapse()
                           ->pluck('buyer')
                           ->unique()
                           ->values();

        return $this->showAll(new BuyerCollection(BuyerResource::collection($buyers)));
    }
}
