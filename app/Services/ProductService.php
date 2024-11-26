<?php
namespace App\Services;

use App\AO\ProductAo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ProductService extends BaseService implements IBaseService 
{
    public function __construct(private ProductAo $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function findByName($name){
        $product = $this->productRepository->search(['name' => $name])->first();
        if(!$product){
            throw new NotFoundResourceException("Producto no encontrado", 404);
        }

        return $product ;
    }
} 

?>