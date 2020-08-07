<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Seller\SellerCollection;

class SellerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('scope:read-general')->only('show');
        $this->middleware('can:view,seller')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();

        return $this->showAll(Seller::resourceCollection($sellers));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return new SellerResource($seller);
    }
}
