<?php

namespace App\Http\Controllers\Product;

use App\User;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionCollection;

class ProductBuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('transform.input:' . TransactionCollection::class)->only('store');
        $this->middleware('scope:purchase-product')->only('store');
        $this->middleware('can:view,buyer')->only('store');
    }

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
            'quantity' => 'required|integer|min:1|max:' . $product->quantity
        ]);

        return DB::transaction(function() use ($request, $product, $buyer) {
            $transaction = Transaction::create([
                'product_id' => $product->id, 
                'buyer_id' => $buyer->id,
                'quantity' => $request->quantity,
                'total_price' => $product->price * $request->quantity
            ]);

            $product->update([
                'quantity' => $product->quantity - $request->quantity
            ]);

            return new TransactionResource($transaction);
        });
    }
}
