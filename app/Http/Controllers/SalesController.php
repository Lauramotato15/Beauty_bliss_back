<?php

namespace App\Http\Controllers;


use App\Http\Requests\SalesCreateRequest;
use App\Http\Resources\SalesResource;
use App\Services\SaleService;

class SalesController extends Controller
{
    public function __construct(private SaleService $serviceSales)
    {
        
    }

    public function store(SalesCreateRequest $request){
        $stockCreate = $request->all(); 
        $newStock = $this->serviceSales->create($stockCreate);
        return new SalesResource($newStock);
    }    

    public function index(){
        $stocks = $this->serviceSales->all();
        return SalesResource::collection($stocks);
    }

    public function update($id, SalesCreateRequest $request){
        $stockUpdate = $this->serviceSales->update($id, $request->all());
        return new SalesResource($stockUpdate);
    }

    public function destroy($id){
        $stockDelete = $this->serviceSales->delete($id);
        if($stockDelete){
            return response()->json('Accion realizada con exito',200);
        }

        return response()->json(null, 204);   
    }

    public function show($id){
        $stockFind = $this->serviceSales->find($id);
        return new SalesResource($stockFind);
    }
}
