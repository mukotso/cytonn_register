<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::orderBy('created_at', 'ASC')->get();
    }

    public function deleteCategory($CategoryId)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            Category::destroy($CategoryId);
            return response()->json(['message' => "Category Deleted successfully"], 200);
        }else {
            abort(401);
        }

    }

    public function createCategory(array $CategoryDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
             Category::create($CategoryDetails);
            return response()->json(['message' => "Category Created successfully"], 200);
        }else {
            abort(401);
        }

    }

    public function updateCategory($Category, $newDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
             $Category->update($newDetails);
            return response()->json(['message' => "Category Details Updated successfully"], 200);
        }else {
            abort(401);
        }

    }


}

