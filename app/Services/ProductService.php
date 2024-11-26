<?php
namespace App\Services;

use App\AO\ProductAo;

class ProductService extends BaseService implements IBaseService 
{
    public function __construct(private ProductAo $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function findByName($name){
        $product = $this->productRepository->search(['name' => $name])->first();
        if(!$product){
            return null;
        }

        return $product ;
    }
} 

?>