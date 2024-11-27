<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(private Product $productModel)
    {
        parent::__construct($productModel);
    }

    public function search($condition){
        return $this->productModel::where($condition)->get();
    }
}
?>