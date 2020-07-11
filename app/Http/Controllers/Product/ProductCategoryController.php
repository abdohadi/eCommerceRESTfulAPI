<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryCollection;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;

        return new CategoryCollection(CategoryResource::collection($categories));
    }

    /**
     * Add the a category to a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Category $category)
    {
        if ($product->categories->contains($category)) {
            return $this->errorResponse("The specified category is already a category of this product", 409);
        }

        $product->categories()->syncWithoutDetaching($category);

        return new CategoryCollection(CategoryResource::collection($product->fresh()->categories));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Category $category)
    {
        if (! $product->categories->contains($category)) {
            return $this->errorResponse("The specified category is not a category of this product", 404);
        }

        $product->categories()->detach($category);
        
        return new CategoryCollection(CategoryResource::collection($product->fresh()->categories));
    }
}
