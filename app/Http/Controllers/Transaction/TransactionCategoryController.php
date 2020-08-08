<?php

namespace App\Http\Controllers\Transaction;

use App\Category;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;

class TransactionCategoryController extends ApiController
{
    public function __construct()
    {        
        $this->middleware('client.credentials')->only('index');
        $this->middleware('can:view,transaction')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $categories = $transaction->product->categories;

        return $this->showAll(Category::resourceCollection($categories));
    }
}
