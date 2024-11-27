<?php
namespace App\Repositories;

use App\Models\SalesDetails;

class SaleDetailRepository extends BaseRepository implements IBaseRepository 
{
    public function __construct(private SalesDetails $saleDetail)
    {
        parent::__construct($saleDetail);
    }
}
?>