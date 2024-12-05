<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    /** @use HasFactory<\Database\Factories\SalesFactory> */
    use HasFactory;
    protected $fillable = [
        'id_user',
        'total_value',
        'created_at', 
    ]; 

    public function user(){
        return $this->belongsTo(User::class, 'id_user','id'); 
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function details(){
        return $this->hasMany(SalesDetails::class, 'id_sale');
    }
}
