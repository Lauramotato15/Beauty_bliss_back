<?php
namespace App\Services;

use App\AO\ProductAo;

class ProductService extends BaseService implements IBaseService 
{
    public function __construct(private ProductAo $productRepository)
    {
        parent::__construct($productRepository);
    }
} 

?>