<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $departments = Department::filter($request->all())
            ->with('creator')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.departments.index', [
            'departments' => $departments,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create(array_merge($request->validated()));

        return redirect()->route('departments.index', $request->query())
            ->with('message', 'The department has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department, Request $request)
    {
        return view('dashboard.departments.show', [
            'department' => $department,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department, Request $request)
    {
        return view('dashboard.departments.edit', [
            'department' => $department,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index', $request->query())
            ->with('message', 'The department has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
