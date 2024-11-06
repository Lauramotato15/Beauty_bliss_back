<?php
namespace App\Services;

use App\AO\SaleDetailAo;
use App\Services\BaseService;
use App\Services\IBaseService;

class SaleDetailService extends BaseService implements IBaseService 
{
    public function __construct(private SaleDetailAo $saleDetailRepository)
    {
        parent::__construct($saleDetailRepository);
    }
}
?>