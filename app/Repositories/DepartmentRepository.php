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
            return Department::destroy($departmentId);
        }else {
            abort(401);
        }

    }

    public function createDepartment(array $departmentDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            return Department::create($departmentDetails);
        }else {
            abort(401);
        }

    }

    public function updateDepartment($department, $newDetails)
    {
        $user=Auth::user();
        if($user->is_admin==1){
            return $department->update($newDetails);
        }else {
            abort(401);
        }
    }


}
