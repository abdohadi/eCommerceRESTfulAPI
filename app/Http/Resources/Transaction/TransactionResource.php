<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identifier' => (int) $this->id,
            'product' => (string) $this->product_id,
            'buyer' => (string) $this->buyer_id,
            'quantity' => (int) $this->quantity,
            'cost' => (string) $this->total_price,
            'creationDate' => (string) $this->created_at,
            'lastChange' => (string) $this->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('transactions.show', $this->id)
                ],
                [
                    'rel' => 'transaction.buyer',
                    'href' => route('buyers.show', $this->buyer_id)
                ],
                [
                    'rel' => 'transaction.product',
                    'href' => route('products.show', $this->product_id)
                ],
                [
                    'rel' => 'transaction.categories',
                    'href' => route('transactions.categories.index', $this->id)
                ],
                [
                    'rel' => 'transaction.seller',
                    'href' => route('transactions.sellers.index', $this->id)
                ],
            ]
        ];
    }
}
