<?php
namespace App\AO;

use App\Models\Stock;

class StockAo extends BaseAo implements IBaseAo
{
    public function __construct(private Stock $stockModel)
    {
        parent::__construct($stockModel);
    }
}
?>