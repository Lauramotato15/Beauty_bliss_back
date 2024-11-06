<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;


class ProductController extends Controller
{
    public function __construct(private ProductService $serviceProduct)
    {
        
    }

    public function store(ProductCreateRequest $request){
        $productCreate = $request->all(); 
        $newProduct = $this->serviceProduct->create($productCreate);
        return new ProductResource($newProduct);
    }    

    public function index(){
        $products = $this->serviceProduct->all();
        return ProductResource::collection($products);
    }

    public function update($id, ProductCreateRequest $request){
        $productUpdate = $this->serviceProduct->update($id, $request->all());
        return new ProductResource($productUpdate); 
    }

    public function destroy($id){
        $productDelete = $this->serviceProduct->delete($id);
        if($productDelete){
            return response()->json('Accion realizada con exito',200);
        }

        return response()->json(null, 204);   
    }

    public function show($id){
        $productFind = $this->serviceProduct->find($id);
        return new ProductResource($productFind);
    }
}
