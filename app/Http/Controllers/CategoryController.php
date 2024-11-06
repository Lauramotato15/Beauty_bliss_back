<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
class CategoryController extends Controller
{
    public function __construct(private CategoryService $serviceCategory)
    {
        
    }

    public function store(CategoryCreateRequest $request){
        $categoryCreate = $request->all(); 
        $newProduct = $this->serviceCategory->create($categoryCreate);
        return new CategoryResource($newProduct);
    }    

    public function index(){
        $categorys = $this->serviceCategory->all();
        return CategoryResource::collection($categorys);
    }

    public function update($id, CategoryCreateRequest $request){
        $categoryUpdate = $this->serviceCategory->update($id, $request->all());
        return new CategoryResource($categoryUpdate); 
    }

    public function destroy($id){
        $categoryDelete = $this->serviceCategory->delete($id);
        if($categoryDelete){
            return response()->json('Accion realizada con exito',200);
        }

        return response()->json(null, 204);   
    }

    public function show($id){
        $categoryFind = $this->serviceCategory->find($id);
        return new CategoryResource($categoryFind);
    }
}
