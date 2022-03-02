<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentsController extends Controller
{
    public $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }


    public function index()
    {
        $departments = $this->departmentRepository->getAllDepartments();
        if(request()->expectsJson()) {
            return response()->json($departments, 200);
        }else{
            return  view('departments.index', compact('departments'));
        }

    }

    public function store(DepartmentRequest $request)
    {
        return $this->departmentRepository->createDepartment($request->all());
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        return $this->departmentRepository->updateDepartment($department, $request->all());
    }

    public function destroy(Department $department)
    {
       return $this->departmentRepository->deleteDepartment($department->id);
    }
}
