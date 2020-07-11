<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => (string) $this->name,
            'details' => (string) $this->description,
            'stock' => (int) $this->quantity,
            'price' => (double) $this->price,
            'picture' => url("storage/images/" . $this->image),
            'situation' => (string) $this->status,
            'seller' => (int) $this->seller_id,
            'creationDate' => (string) $this->created_at,
            'lastChange' => (string) $this->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $this->id)
                ],
                [
                    'rel' => 'product.seller',
                    'href' => route('sellers.show', $this->seller->id)
                ],
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $this->id)
                ],
                [
                    'rel' => 'product.transactions',
                    'href' => route('products.transactions.index', $this->id)
                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $this->id)
                ],
            ]
        ];
    }
}
