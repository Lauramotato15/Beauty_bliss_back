<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(private Product $productModel)
    {
        parent::__construct($productModel);
    }

    public function search($condition){
        Log::info($this->productModel::where($condition)->toSql());
        return $this->productModel::where($condition)->get();
    }

    public function findByCategory($condition){
        Log::info($this->productModel::where($condition)->toSql());
        return $this->productModel::where($condition)->get();
    }
}
?>