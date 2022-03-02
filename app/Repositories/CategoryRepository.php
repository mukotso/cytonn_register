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
            return Category::destroy($CategoryId);
        }else {
            abort(401);
        }

    }

    public function createCategory(array $CategoryDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            return Category::create($CategoryDetails);
        }else {
            abort(401);
        }

    }

    public function updateCategory($Category, $newDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            return $Category->update($newDetails);
        }else {
            abort(401);
        }

    }


}

