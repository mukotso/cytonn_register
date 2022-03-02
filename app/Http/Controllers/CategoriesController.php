<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function index()
    {
        $categories = $this->categoryRepository->getAllcategories();
        if(request()->expectsJson()) {
            return response()->json($categories, 200);
        }else{
            return  view('categories.index', compact('categories'));
        }

    }

    public function store(CategoryRequest $request)
    {
        return $this->categoryRepository->createCategory($request->all());
    }

    public function update(CategoryRequest $request, Category $category)
    {
       return  $this->categoryRepository->updateCategory($category, $request->all());
    }

    public function destroy(Category $category)
    {
        return $this->categoryRepository->deleteCategory($category->id);
    }
}
