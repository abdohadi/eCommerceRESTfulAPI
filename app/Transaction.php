<?php

namespace App;

use App\Buyer;
use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionCollection;

class Transaction extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['buyer_id', 'product_id', 'quantity', 'total_price'];

    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }

    public function Product()
    {
    	return $this->belongsTo(Product::class);
    }

    public static function resourceCollection(Collection $collection)
    {
        return new TransactionCollection(TransactionResource::collection($collection));
    }
}
