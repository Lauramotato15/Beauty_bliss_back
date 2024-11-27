<?php
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends BaseService implements IBaseService 
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }
}
?>