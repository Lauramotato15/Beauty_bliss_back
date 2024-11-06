<?php
namespace App\AO;

use App\Models\Product;

class ProductAo extends BaseAo implements IBaseAo 
{
    public function __construct(private Product $productModel)
    {
        parent::__construct($productModel);
    }
}
?>