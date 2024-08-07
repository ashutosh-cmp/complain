<?php

namespace App\Http\Controllers;

use App\Models\SubDepartment;
use App\Http\Requests\StoreSubDepartmentRequest;
use App\Http\Requests\UpdateSubDepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);
        $subDepartments = SubDepartment::with(['department', 'creator'])
            ->orderBy('order')
            ->filter($request->all())
            ->paginate($perPage);

        $departments = Department::orderBy('name')->get();

        $creators = User::all();

        return view('dashboard.subDepartments.index', [
            'subDepartments' => $subDepartments,
            'departments' => $departments,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $departments = Department::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('dashboard.subDepartments.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubDepartmentRequest $request): RedirectResponse
    {
        SubDepartment::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('subDepartments.index', $request->query())
            ->with('message', 'Sub-Department create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubDepartment $subDepartment, Request $request): View
    {
        $departments = Department::where('status', 1)
            ->orderBy('name', 'desc')
            ->get();
        return View('dashboard.subDepartments.show', [
            'subDepartment' => $subDepartment,
            'departments' => $departments,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubDepartment $subDepartment, Request $request): View
    {
        $departments = Department::where('status', 1)
            ->orWhere('id', $subDepartment->department_id)
            ->orderBy('name', 'desc')
            ->get();
        return view('dashboard.subDepartments.edit', [
            'subDepartment' => $subDepartment,
            'departments' => $departments,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubDepartmentRequest $request, SubDepartment $subDepartment): RedirectResponse
    {
        $subDepartment->update($request->validated());

        return redirect()->route('subDepartments.index', $request->query())
            ->with('message', 'Your SubDepartment is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubDepartment $subDepartment, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');

        $subDepartment->delete();

        return redirect()->route('subDepartments.index', $filters)
            ->with('message', 'Subdepartment is delete successfully');
    }
}