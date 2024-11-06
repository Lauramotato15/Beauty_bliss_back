<?php
namespace App\Http\Controllers;

use App\Http\Requests\SaleDetailCreateRequest;
use App\Http\Resources\SaleDetailResource;
use App\Services\SaleDetailService as ServicesSaleDetailService;

class SalesDetailsController extends Controller
{
    public function __construct(private ServicesSaleDetailService $serviceSales)
    {
        
    }

    public function store(SaleDetailCreateRequest $request){
        $stockCreate = $request->all(); 
        $newStock = $this->serviceSales->create($stockCreate);
        return new SaleDetailResource($newStock);
    }    

    public function index(){
        $stocks = $this->serviceSales->all();
        return SaleDetailResource::collection($stocks);
    }

    public function update($id, SaleDetailCreateRequest $request){
        $stockUpdate = $this->serviceSales->update($id, $request->all());
        return new SaleDetailResource($stockUpdate);
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
        return new SaleDetailResource($stockFind);
    }
}
