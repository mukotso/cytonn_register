<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function getAllDepartments()
    {
            return Department::orderBy('created_at', 'DESC')->get();
    }

    public function deleteDepartment($departmentId)
    {
        $user=Auth::user();
        if($user->is_admin==1){
             Department::destroy($departmentId);
            return response()->json(['message' => "Department Deleted successfully"], 200);
        }else {
            abort(401);
        }

    }

    public function createDepartment(array $departmentDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
             Department::create($departmentDetails);
            return response()->json(['message' => "Department Created successfully"], 200);
        }else {
            abort(401);
        }

    }

    public function updateDepartment($department, $newDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
             $department->update($newDetails);
            return response()->json(['message' => "Department Details updated successfully"], 200);
        }else {
            abort(401);
        }
    }


}
