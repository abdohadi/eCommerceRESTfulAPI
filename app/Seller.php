<?php

namespace App;

use App\Product;
use App\Scopes\SellerScope;

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
}
