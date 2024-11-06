<?php
namespace App\AO;

use App\Models\Category;

class CategoryAo extends BaseAo implements IBaseAo
{
    public function __construct(private Category $categoryModel)
    {
        parent::__construct($categoryModel);
    }
} 
?>