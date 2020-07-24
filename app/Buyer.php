<?php

namespace App;

use App\User;
use App\Transaction;
use App\Scopes\BuyerScope;
use Illuminate\Support\Collection;
use App\Http\Resources\Buyer\BuyerResource;
use App\Http\Resources\Buyer\BuyerCollection;

class Buyer extends User
{
	protected static function booted()
    {
        static::addGlobalScope(new BuyerScope);
    }

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

    public static function resourceCollection(Collection $collection)
    {
        return new BuyerCollection(BuyerResource::collection($collection));
    }
}
