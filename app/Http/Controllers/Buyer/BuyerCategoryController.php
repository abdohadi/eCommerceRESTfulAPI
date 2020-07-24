<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
                            ->with('product.categories')
                            ->get()
                            ->pluck('product.categories')
                            ->collapse()
                            ->unique()
                            ->values();

        return new CategoryCollection(CategoryResource::collection($categories));
    }
}
