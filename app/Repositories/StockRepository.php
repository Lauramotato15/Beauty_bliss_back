<?php
namespace App\Repositories;
use App\Models\Stock;
use App\Repositories\BaseRepository;
use App\Repositories\IBaseRepository;

class StockRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(private Stock $stockModel)
    {
        parent::__construct($stockModel);
    }
}
?>