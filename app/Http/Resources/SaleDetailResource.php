<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity, 
            "total_value" => $this->total_value, 
            "id_product" => new ProductResource($this->product),
            "id_sale" => new SalesResource($this->sale), 
        ]; 
    }
}
