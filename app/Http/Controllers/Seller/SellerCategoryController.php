<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $categories = $seller->products()
                             ->with('categories')
                             ->get()
                             ->pluck('categories')
                             ->collapse()
                             ->unique('id')
                             ->values();
        
        return $this->showAll(new CategoryCollection(CategoryResource::collection($categories)));
    }
}
