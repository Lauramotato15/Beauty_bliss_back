<?php
namespace App\Services;

use App\Models\Stock;
use App\Repositories\ProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductService extends BaseService implements IBaseService 
{
    public function __construct(private ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function findByName($name){
        $product = $this->productRepository->search([['name', "LIKE", "%$name%"]])->first();
        if(!$product)throw new NotFoundHttpException('Recurso no encontrado');
        
        return $product ;
    }

    public function createProductWithFile($request)
    {
      $file = $request->file('photo');
      $data = $request->all();
      if ($file) {
        $fileName = time(). '_' .$file->getClientOriginalName();
        $file->move(storage_path('app/public/uploads'), $fileName);
  
        $data['photo'] = $fileName;
      }

      $stock = $request->input('quantity');
  
      $create = $this->productRepository->create($data);

      if ($stock) {
        $create->stocks()->create(['quantity' => $stock]);
      }
  
      return $create;
    }
} 

?>