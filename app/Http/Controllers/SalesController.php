<?php

namespace App\Http\Controllers;


use App\Http\Requests\SalesCreateRequest;
use App\Http\Resources\SalesCollection;
use App\Http\Resources\SalesResource;
use App\Services\SaleService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalesController extends Controller
{
    public function __construct(private SaleService $serviceSales)
    {
        
    }

    public function index(){
        $stocks = $this->serviceSales->all();
        return new SalesCollection($stocks);
    }

    public function store(SalesCreateRequest $request){
        $newStock = $this->serviceSales->createSaleWithDetail($request->except('products'), $request->input('products'));
        return new SalesResource($newStock);
    }    

    public function update($id, SalesCreateRequest $request){
        try {
            $stockUpdate = $this->serviceSales->update($id, $request->all());
            return new SalesResource($stockUpdate);

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        } 
    }

    public function show($id){
        $stockFind = $this->serviceSales->find($id);
        return new SalesResource($stockFind);
    }

    public function findIdUser(){
        $sale = $this->serviceSales->findByIdUser();
        return new SalesCollection($sale);
    }

    public function destroy($id){
        try {
            $resp = $this->serviceSales->delete($id);
            return $resp; 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        }  
    }
}
