<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function getAllDepartments()
    {
        return Department::orderBy('created_at', 'ASC')->get();
    }

    public function deleteDepartment($departmentId)
    {
        return Department::destroy($departmentId);
    }

    public function createDepartment(array $departmentDetails)
    {
        return Department::create($departmentDetails);
    }

    public function updateDepartment($department, $newDetails)
    {
        return $department->update($newDetails);
    }


}
