<?php

namespace App\Http\Resources;

use App\Traits\HasResourceResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    use HasResourceResponse; 
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id, 
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'brand' => $this->brand, 
            'photo' => $this->photo,
            'category' => new CategoryResource($this->category),
            'stock' => StockResource::collection($this->stocks),
        ]; 
    }
}
