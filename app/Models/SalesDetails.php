<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    /** @use HasFactory<\Database\Factories\SalesDetailsFactory> */
    use HasFactory;
    protected $fillable = [
        'quantity',
        'total_value', 
        'id_product', 
        'id_sale', 
    ];

    public function product(){
        return $this->belongsTo(Product::class,'id_product','id');
    }

    public function sale(){
        return $this->belongsTo(Sales::class,'id_sale','id');
    }
} 
