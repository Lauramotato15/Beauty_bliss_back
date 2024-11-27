<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(private Category $categoryModel)
    {
        parent::__construct($categoryModel);
    }
} 
?>