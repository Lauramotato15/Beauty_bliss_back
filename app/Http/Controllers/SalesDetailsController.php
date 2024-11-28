<?php
namespace App\Http\Controllers;

use App\Http\Requests\SaleDetailCreateRequest;
use App\Http\Resources\SaleDetailResource;
use App\Services\SaleDetailService as ServicesSaleDetailService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalesDetailsController extends Controller
{
    public function __construct(private ServicesSaleDetailService $serviceDetailSales)
    {
        
    }

    public function index(){
        $stocks = $this->serviceDetailSales->all();
        return SaleDetailResource::collection($stocks);
    }

    public function store(SaleDetailCreateRequest $request){
        $stockCreate = $request->all(); 
        $newStock = $this->serviceDetailSales->create($stockCreate);
        return new SaleDetailResource($newStock);
    }    

    public function update($id, SaleDetailCreateRequest $request){
        try {
            $stockUpdate = $this->serviceDetailSales->update($id, $request->all());
            return new SaleDetailResource($stockUpdate);

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        } 
    }

    public function show($id){
        $stockFind = $this->serviceDetailSales->find($id);
        return new SaleDetailResource($stockFind);
    }

    public function destroy($id){
        try {
            $resp = $this->serviceDetailSales->delete($id);
            return $resp; 

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => $e->getMessage()], 404);

        }   
    }
}
