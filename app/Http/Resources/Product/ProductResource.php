<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        'name' => $this->name,
        'description' => $this->detail,
        'price' => $this->price,
        'stock' => ($this->stock > 0)?$this->stock:"out of stock",
        'discount' => $this->discount,
        'final_price' =>($this->discount > 0)?(round((1 - ($this->discount/100))*$this->price,2)):$this->price,
        'rating' =>($this->reviews->count() > 0)?round($this->reviews->sum('star')/$this->reviews->count()):"No review found",
        'href' => [
         'review' => route('reviews.index',$this->id)
        ]

        ];
    }
}
