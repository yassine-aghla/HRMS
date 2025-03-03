<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Http\Controllers\Controller;


class DepartmentController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:department-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:department-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    // }

    
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(DepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Department deleted successfully.');
    }
}
