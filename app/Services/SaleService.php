<?php
namespace App\Services;

use App\Repositories\SaleRepository;
use App\Services\BaseService;
use App\Services\IBaseService;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SaleService extends BaseService implements IBaseService
{
    public function __construct(private SaleRepository $salesRepository)
    {
        parent::__construct($salesRepository);
    }

    public function createSaleWithDetail(array $saleInfo, array $saleDetail){
        $sale = $this->create([...$saleInfo, 'id_user'=>FacadesAuth::user()->id]);
        $sale->details()->createMany($saleDetail);
        return $sale;
    }

    public function findByIdUser(){
        $userId = FacadesAuth::user()->id;
        if(!$userId) throw new NotFoundHttpException('Recurso no encontrado');
        
        return $this->salesRepository->findByIdUser($userId);
    }
}