<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Http\Requests\StoreComplainRequest;
use App\Http\Requests\UpdateComplainRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $complaints = Complain::filter($request->all())
            ->with('creator')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.complaints.index', [
            'complaints' => $complaints,
            'creators' => $creators,
            'filters' => $request->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComplainRequest $request): RedirectResponse
    {
        Complain::create(array_merge($request->validated(), ['created_by' => auth()->user->id]));

        return redirect()->route('complaints.index', $request->query())
            ->with('message', 'Your Complaint is created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complain $complain, Request $request): View
    {
        return view('dashboard.complaints.show', [
            'complain' => $complain,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complain $complain, Request $request): View
    {
        return view('dashboard.complaints.edit', [
            'complain' => $complain,
            'filters' => $request->query()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComplainRequest $request, Complain $complain)
    {
        $complain->update($request->validated());

        return redirect()->route('complaints.index', $request->query())
            ->with('message', 'Your complaint is update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complain $complain, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');

        $complain->delete();

        return redirect()->route('complaints.index', $filters)
            ->with('message', 'Your complaint is delete successfully');
    }
}
