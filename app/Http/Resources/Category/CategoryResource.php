<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identifier' => (int) $category->id,
            'title' => (string) $category->name,
            'details' => (string) $category->description,
            'creationDate' => (string) $category->created_at,
            'lastChange' => (string) $category->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('categories.show', $this->id)
                ],
                [
                    'rel' => 'category.products',
                    'href' => route('categories.products.index', $this->id)
                ],
                [
                    'rel' => 'category.sellers',
                    'href' => route('categories.sellers.index', $this->id)
                ],
                [
                    'rel' => 'category.transactions',
                    'href' => route('categories.transactions.index', $this->id)
                ],
                [
                    'rel' => 'category.buyers',
                    'href' => route('categories.buyers.index', $this->id)
                ],
            ]
        ];
    }
}
