<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionCollection;

class SellerTransactionController extends ApiController
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
        $transactions = $seller->products()
                               ->whereHas('transactions')
                               ->with('transactions')
                               ->get()
                               ->pluck('transactions')
                               ->collapse();

        return $this->showAll(Transaction::resourceCollection($transactions));
    }
}
