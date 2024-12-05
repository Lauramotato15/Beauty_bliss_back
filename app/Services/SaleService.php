<?php
namespace App\Services;

use App\Repositories\SaleRepository;
use App\Services\BaseService;
use App\Services\IBaseService;

class SaleService extends BaseService implements IBaseService
{
    public function __construct(private SaleRepository $salesRepository)
    {
        parent::__construct($salesRepository);
    }

    public function createSaleWithDetail(array $saleInfo, array $saleDetail){
        $sale = $this->create($saleInfo);
        $sale->details()->createMany($saleDetail);
        return $sale;

    }
}