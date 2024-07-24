<?php

namespace App\Http\Controllers;

use App\Documents\SubjectDocument;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $subjects = Subject::filter($request->all())
            ->with('creator')
            ->withCount('topics')
            ->orderBy('order')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.subjects.index', [
            'subjects' => $subjects,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        Subject::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('subjects.index', $request->query())
            ->with('message', 'The subject has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @param Request $request
     * @return View
     */
    public function show(Subject $subject, Request $request): View
    {
        return view('dashboard.subjects.show', [
            'subject' => $subject,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subject $subject
     * @param Request $request
     * @return View
     */
    public function edit(Subject $subject, Request $request): View
    {
        return view('dashboard.subjects.edit', [
            'subject' => $subject,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubjectRequest $request
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function update(UpdateSubjectRequest $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.index', $request->query())
            ->with('message', 'The subject has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Subject $subject, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');

        if ($subject->topics()->exists()) {
            return redirect()->route('subjects.index', $filters)
                ->with('error', 'Cannot delete this subject as it has one or more associated topics.');
        }

        $subject->delete();

        return redirect()->route('subjects.index', $filters)
            ->with('message', 'The subject has been deleted successfully.');
    }

    /**
     * Download the specified resource in PDF format.
     *
     * @param Subject $subject
     * @param Request $request
     * @return View
     */
    public function downloadPDF($id)
    {
        $subject = Subject::find($id);
        $subjectPDF = new SubjectDocument($subject);
        return $subjectPDF->generate();
    }

    /**
     * Download the specified resource in HTML format.
     *
     * @param $id
     * @param Request $request
     * @return View
     */
    public function downloadHTML($id)
    {
        $subject = Subject::find($id);
        $subjectHTML = new SubjectDocument($subject);
        return $subjectHTML->generate('html');
    }
}
