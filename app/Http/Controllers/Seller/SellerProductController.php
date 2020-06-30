<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
    	$products = $seller->products;

    	return $this->showAll($products);
    }

    public function store(Request $request, Seller $seller)
    {
    	$request->validate([
    		'name' => 'required',
    		'description' => 'required',
    		'quantity' => 'required|integer|min:1',
    		'price' => 'required|numeric',
    		'image' => 'required|image|max:2024'
    	]);

    	$attributes = $request->only(['name', 'description', 'quantity', 'price']);

    	$product = new Product($attributes);
    	$product->image = $request->image->store('');
    	$product->status = Product::UNAVAILABLE_PRODUCT;
    	$product->seller_id = $seller->id;

    	$product->save();

    	return $this->showOne($product, 201);
    }

    public function update(Request $request, Seller $seller, Product $product)
    {
        $this->checkSeller($product, $seller);

        $request->validate([
            'quantity' => 'integer|min:1',
            'price' => 'numeric',
            'image' => 'image|max:2024',
            'status' => 'in:' . Product::UNAVAILABLE_PRODUCT . ',' . Product::AVAILABLE_PRODUCT
        ]);

        $product->fill($request->only([
            'name', 'description', 'quantity', 'price'
        ]));

        if ($request->hasFile('image')) {
            if (! in_array($product->image, ['1.jpeg', '2.jpeg', '3.jpeg'])) {
                Storage::delete($product->image);
            }

            $product->image = $request->image->store('');
        }

        if ($request->has('status')) {
            if ($request->status == Product::AVAILABLE_PRODUCT && $product->categories()->count() === 0) {
                return $this->errorResponse("An available product must have at least one category", 409);
            }

            $product->status = $request->status;
        }

        if ($product->isClean()) {
            return $this->errorResponse("You need to specify a different value to update", 422);
        }

        $product->save();

        return $this->showOne($product);
    }

    public function destroy(Request $request, Seller $seller, Product $product)
    {
        $this->checkSeller($product, $seller);

        $product->delete();

        Storage::delete($product->image);

        return $this->showOne($product);
    }

    private function checkSeller(Product $product, Seller $seller)
    {
        if ($product->seller->isNot($seller)) {
            return $this->errorResponse("The specified seller is not the actual seller of the product", 422);
        }
    }
}
