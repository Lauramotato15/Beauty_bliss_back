<?php
namespace App\Services;

use App\AO\CategoryAo;

class CategoryService extends BaseService implements IBaseService 
{
    public function __construct(private CategoryAo $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }
}
?>