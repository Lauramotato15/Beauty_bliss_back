<?php

namespace App\Traits;
trait HasResourceResponse {
    public function with($request){ 
        return [
            'status' => 200,
            'success' => true
        ];
    }
}