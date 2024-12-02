<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function __construct(private ProductService $serviceProduct)
    {
        
    }

    public function index(){
        $products = $this->serviceProduct->all();
        return new ProductCollection($products);
    }

    public function store(ProductCreateRequest $request){
        $newProduct = $this->serviceProduct->createProductWithFile($request);
        return new ProductResource($newProduct);
    }    

    
    public function update($id, ProductUpdateRequest $request){
        try {
            $productUpdate = $this->serviceProduct->update($id, $request->all());
            return new ProductResource($productUpdate); 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } 
    }
    
    public function show($id){
        $productFind = $this->serviceProduct->find($id);
        return new ProductResource($productFind);
    }
    
    public function findByName($name){
        $productFind = $this->serviceProduct->findByName($name);
        return new ProductResource($productFind);
    }

    public function destroy($id){
        try {
            $resp = $this->serviceProduct->delete($id);
            return $resp; 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        } 
    }
}
