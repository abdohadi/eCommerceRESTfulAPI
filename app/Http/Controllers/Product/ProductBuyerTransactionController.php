<?php

namespace App\Http\Controllers\Product;

use App\User;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductBuyerTransactionController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        if ($buyer->is($product->seller)) {
            return $this->errorResponse("The specified buyer must be different from the seller", 409);
        }

        if (! $buyer->isVerified()) {
            return $this->errorResponse("The specified buyer is not verified", 409);
        }

        if (! $product->seller->isVerified()) {
            return $this->errorResponse("The seller of the product is not verified", 409);
        }

        if (! $product->isAvailable()) {
            return $this->errorResponse("The specified product is not available", 409);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $transaction = Transaction::create([
            'product_id' => $product->id, 
            'buyer_id' => $buyer->id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity
        ]);

        return $this->showOne($transaction);
    }
}
