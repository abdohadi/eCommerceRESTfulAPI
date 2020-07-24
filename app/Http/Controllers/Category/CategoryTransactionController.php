<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionCollection;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $transactions = $category->products()
                                 ->whereHas('transactions')
                                 ->with('transactions')
                                 ->get()
                                 ->pluck('transactions')
                                 ->collapse();

        return $this->showAll(Transaction::resourceCollection($transactions));
    }
}
