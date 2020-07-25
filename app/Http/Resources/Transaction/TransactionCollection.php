<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }

    public static function originalAttribute($attribute)
    {
        $attributes = [
            'identifier' => 'id',
            'product' => 'product_id',
            'buyer' => 'buyer_id',
            'quantity' => 'quantity',
            'cost' => 'total_price',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
        ];

        return $attributes[$attribute] ?? null;
    }

    public static function transformedAttribute($attribute)
    {
        $attributes = [
            'id' => 'identifier',
            'product_id' => 'product',
            'buyer_id' => 'buyer',
            'quantity' => 'quantity',
            'total_price' => 'cost',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
        ];

        return $attributes[$attribute] ?? null;
    }
}
