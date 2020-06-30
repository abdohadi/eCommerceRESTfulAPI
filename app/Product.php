<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable = ['seller_id', 'name', 'description', 'quantity', 'status', 'image', 'price'];

    public function seller()
    {
    	return $this->belongsTo(Seller::class);
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

    public function isAvailable()
    {
        return $this->status == static::AVAILABLE_PRODUCT;
    }
}
