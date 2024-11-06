<?php
namespace App\Services;
use App\AO\StockAo;
use App\Services\BaseService;
use App\Services\IBaseService;

class StockService extends BaseService implements IBaseService 
{
    public function __construct(private StockAo $stockRepository)
    {
        parent::__construct($stockRepository);
    }
}
?>