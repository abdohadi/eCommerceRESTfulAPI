<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionCollection;

class BuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,buyer')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;

        return $this->showAll(Transaction::resourceCollection($transactions));
    }
}
