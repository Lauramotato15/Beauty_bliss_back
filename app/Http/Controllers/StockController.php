<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCreateRequest;
use App\Http\Resources\StockResource;
use App\Services\StockService;

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
        $stockUpdate = $this->serviceStock->update($id, $request->all());
        return new StockResource($stockUpdate);
    }

    public function destroy($id){
        $stockDelete = $this->serviceStock->delete($id);
        if($stockDelete){
            return response()->json('Accion realizada con exito',200);
        }

        return response()->json(null, 204);   
    }

    public function show($id){
        $stockFind = $this->serviceStock->find($id);
        return new StockResource($stockFind);
    }
}
