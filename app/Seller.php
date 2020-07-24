<?php

namespace App;

use App\Product;
use App\Scopes\SellerScope;
use Illuminate\Support\Collection;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Resources\Seller\SellerCollection;

class Seller extends User
{
	protected static function booted()
    {
        static::addGlobalScope(new SellerScope);
    }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public static function resourceCollection(Collection $collection)
    {
        return new SellerCollection(SellerResource::collection($collection));
    }
}
