<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class Product extends Model
{
    use SoftDeletes;
    
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

    public static function resourceCollection(Collection $collection)
    {
        return new ProductCollection(ProductResource::collection($collection));
    }
}
