<?php

namespace App;

use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;

class Category extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['name', 'description'];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public static function resourceCollection(Collection $collection)
    {
        return new CategoryCollection(CategoryResource::collection($collection));
    }
}
