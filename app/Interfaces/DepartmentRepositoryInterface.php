<?php

namespace App\Interfaces;

interface DepartmentRepositoryInterface
{
    public function getAllDepartments();
    public function deleteDepartment($departmentId);
    public function createDepartment(array $departmentDetails);
    public function updateDepartment($department, $newDetails);
}
