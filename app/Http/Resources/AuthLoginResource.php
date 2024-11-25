<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function with($request){ 
        if(Auth::check()){
            return [
                'status' => 200,
                'success' => true
            ];
        }else{
            return [
                'status' => 401,
                'success' => false
            ];
        }
    }
}
