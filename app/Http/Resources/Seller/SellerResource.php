<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'isVerified' => (string) $this->verified,
            'creationDate' => (string) $this->created_at,
            'lastChange' => (string) $this->updated_at,

            'links' => [
                [
                    'rel' => 'seller.products',
                    'href' => route('sellers.products.index', $this->id)
                ],
                [
                    'rel' => 'seller.categories',
                    'href' => route('sellers.categories.index', $this->id)
                ],
                [
                    'rel' => 'seller.transactions',
                    'href' => route('sellers.transactions.index', $this->id)
                ],
                [
                    'rel' => 'seller.buyers',
                    'href' => route('sellers.buyers.index', $this->id)
                ],
            ]
        ];
    }
}
