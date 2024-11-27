<?php
namespace App\Repositories;

use App\Models\Sales;

class SaleRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(private Sales $saleModel)
    {
        parent::__construct($saleModel);
    }
}
?>