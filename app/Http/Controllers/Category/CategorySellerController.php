<?php

namespace App\Http\Controllers\Category;

use App\Seller;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Seller\SellerCollection;

class CategorySellerController extends ApiController
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
        $sellers = $category->products()
                            ->with('seller')
                            ->get()
                            ->pluck('seller')
                            ->unique()
                            ->values();

        return $this->showAll(Seller::resourceCollection($sellers));
    }
}
