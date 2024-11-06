<?php
namespace App\AO;

use App\Models\Sales;

class SaleAo extends BaseAo implements IBaseAo 
{
    public function __construct(private Sales $saleModel)
    {
        parent::__construct($saleModel);
    }
}
?>