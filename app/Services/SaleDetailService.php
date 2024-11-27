<?php
namespace App\Services;

use App\Repositories\SaleDetailRepository;
use App\Services\BaseService;
use App\Services\IBaseService;

class SaleDetailService extends BaseService implements IBaseService 
{
    public function __construct(private SaleDetailRepository $saleDetailRepository)
    {
        parent::__construct($saleDetailRepository);
    }
}
?>