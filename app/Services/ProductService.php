<?php
namespace App\Services;
use App\Repositories\ProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductService extends BaseService implements IBaseService 
{
    public function __construct(private ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function findByName($name){
        $product = $this->productRepository->search(['name' => $name])->first();
        if(!$product)throw new NotFoundHttpException('Recurso no encontrado');
        
        return $product ;
    }

    public function findBybrand($brand){
        $product = $this->productRepository->search(['mar' => $brand])->first();
        if(!$product)throw new NotFoundHttpException('Recurso no encontrado');
        
        return $product ;
    }
} 

?>