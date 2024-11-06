<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    use HasFactory;
    protected $fillable = [
        'quantity',
        'id_product',
    ]; 

    public function product(){
        return $this->belongsTo(Product::class, 'id_product','id'); 
    }
}
