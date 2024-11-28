<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $serviceCategory)
    {
        
    }

    public function index(){
        $categorys = $this->serviceCategory->all();
        return CategoryResource::collection($categorys);
    }

    public function store(CategoryCreateRequest $request){
        $categoryCreate = $request->all(); 
        $newProduct = $this->serviceCategory->create($categoryCreate);
        return new CategoryResource($newProduct);
    }    

    public function update($id, CategoryCreateRequest $request){
        try {
            $categoryUpdate = $this->serviceCategory->update($id, $request->all());
            return new CategoryResource($categoryUpdate); 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        } 
    }

    public function show($id){
        $categoryFind = $this->serviceCategory->find($id);
        return new CategoryResource($categoryFind);
    }

    public function destroy($id){
        try {
            $this->serviceCategory->delete($id);
            return response()->json('Acción realizada con éxito', 204);

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        }   
    }
}
