<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCreateRequest;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Services\StockService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockController extends Controller
{
    public function __construct(private StockService $serviceStock)
    {
        
    }

    public function index(){
        $stocks = $this->serviceStock->all();
        return new StockCollection($stocks);
    }
    
    public function store(StockCreateRequest $request){
        $stockCreate = $request->all(); 
        $newStock = $this->serviceStock->create($stockCreate);
        return new StockResource($newStock);
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
            $resp = $this->serviceStock->delete($id);
            return $resp; 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        } 
    }
}
