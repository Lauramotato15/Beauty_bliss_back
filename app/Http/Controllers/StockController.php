<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCreateRequest;
use App\Http\Resources\StockResource;
use App\Services\StockService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockController extends Controller
{
    public function __construct(private StockService $serviceStock)
    {
        
    }

    public function store(StockCreateRequest $request){
        $stockCreate = $request->all(); 
        $newStock = $this->serviceStock->create($stockCreate);
        return new StockResource($newStock);
    }    

    public function index(){
        $stocks = $this->serviceStock->all();
        return StockResource::collection($stocks);
    }

    public function update($id, StockCreateRequest $request){
        try {
            $stockUpdate = $this->serviceStock->update($id, $request->all());
            return new StockResource($stockUpdate);

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        }
    }
    
    public function show($id){
        $stockFind = $this->serviceStock->find($id);
        return new StockResource($stockFind);
    }

    public function destroy($id){
        try {
            $this->serviceStock->delete($id);
            return response()->json('Acción realizada con éxito', 204);

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        } 
    }
}
