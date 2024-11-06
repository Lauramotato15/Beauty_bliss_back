<?php
namespace App\AO;

use App\Models\SalesDetails;

class SaleDetailAo extends BaseAo implements IBaseAo 
{
    public function __construct(private SalesDetails $saleDetail)
    {
        parent::__construct($saleDetail);
    }
}
?>