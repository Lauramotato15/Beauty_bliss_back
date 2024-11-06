<?php
namespace App\Services;

use App\AO\SaleAo;
use App\Services\BaseService;
use App\Services\IBaseService;

class SaleService extends BaseService implements IBaseService
{
    public function __construct(private SaleAo $salesRepository)
    {
        parent::__construct($salesRepository);
    }
}