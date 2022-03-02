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
//        $this->authorize('update');
        $departments = $this->departmentRepository->getAllDepartments();
        if(request()->expectsJson()) {
            return response()->json($departments, 200);
        }else{
            return  view('departments.index', compact('departments'));
        }

    }

    public function store(DepartmentRequest $request)
    {
//        $this->authorize('update');
        $department = $this->departmentRepository->createDepartment($request->all());
       if(request()->expectsJson()) {
            return response()->json($department, 200);
        }else{
            return  redirect()->route('departments.index');
        }

    }

    public function update(DepartmentRequest $request, Department $department)
    {
//        $this->authorize('update');
        $department = $this->departmentRepository->updateDepartment($department, $request->all());
        if(request()->expectsJson()) {
            return response()->json($department, 200);
        }else{
            return  redirect()->route('departments.index');
        }

    }

    public function destroy(Department $department)
    {
//        $this->authorize('update');
        $this->departmentRepository->deleteDepartment($department->id);
        if(request()->expectsJson()) {
            return response()->json(200);
        }else{
            return  redirect()->route('departments.index');
        }

    }
}
