<?php
namespace App\Services;
use App\Repositories\StockRepository;
use App\Services\BaseService;
use App\Services\IBaseService;

class StockService extends BaseService implements IBaseService 
{
    public function __construct(private StockRepository $stockRepository)
    {
        parent::__construct($stockRepository);
    }
}
?>