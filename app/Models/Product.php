<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'id_category',
        'description', 
        'brand',
        'photo',
    ]; 

    public function category(){
        return $this->belongsTo(Category::class,'id_category');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_product', 'id');
    }

    public function sales(){
        return $this->belongsToMany(Sales::class);
    }

    public function details(){
        return $this->hasMany(SalesDetails::class);
    }
} 
