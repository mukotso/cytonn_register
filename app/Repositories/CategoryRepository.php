<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::orderBy('created_at', 'ASC')->get();
    }

    public function deleteCategory($CategoryId)
    {
        return Category::destroy($CategoryId);
    }

    public function createCategory(array $CategoryDetails)
    {
        return Category::create($CategoryDetails);
    }

    public function updateCategory($Category, $newDetails)
    {
        return $Category->update($newDetails);
    }


}

