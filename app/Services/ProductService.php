<?php
namespace App\Services;
use App\Repositories\ProductRepository;

class ProductService extends BaseService implements IBaseService 
{
    public function __construct(private ProductRepository $productRepository)
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