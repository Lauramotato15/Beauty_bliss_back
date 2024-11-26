<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
        $productCreate = $request->all(); 
        $newProduct = $this->serviceProduct->create($productCreate);
        return new ProductResource($newProduct);
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

    public function findByName(Request $request){
        $productFind = $this->serviceProduct->findByName($request->input('name'))->first();
        return new ProductResource($productFind);
    }
}
