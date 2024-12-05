<?php

namespace App\Http\Resources;

use App\Traits\HasResourceResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
{
    use HasResourceResponse; 
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->loadMissing('details');

        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'products' => new SaleDetailCollection($this->whenLoaded('details')),
            'total_value' => $this->total_value,
            'created_at' => $this->created_at,
        ];
    }
}
