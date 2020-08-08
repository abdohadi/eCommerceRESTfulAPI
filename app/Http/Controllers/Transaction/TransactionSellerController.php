<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Seller\SellerResource;

class TransactionSellerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,transaction')->only('index');
    }

    /**
     * Display a list of the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $seller = $transaction->product->seller;

        return new SellerResource($seller);
    }
}
