<?php

namespace App;

use App\Buyer;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
