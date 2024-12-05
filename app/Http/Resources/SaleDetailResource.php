<?php

namespace App\Http\Resources;

use App\Traits\HasResourceResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
{
    use HasResourceResponse; 
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->loadMissing('product');
        return [
            'id' => $this->id,
            'quantity' => $this->quantity, 
            "total_value" => $this->total_value, 
            "id_product" => new ProductResource($this->whenLoaded('product')),
        ]; 
    }
}
