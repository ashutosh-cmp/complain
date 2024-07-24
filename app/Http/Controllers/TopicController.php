<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TopicController extends Controller
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

        $topics = Topic::with(['subject', 'creator'])
            ->orderBy('order', 'desc')
            ->filter($request->all())
            ->paginate($perPage);

        $subjects = Subject::orderBy('order')->get();

        $creators = User::all();

        return view('dashboard.topics.index', [
            'topics' => $topics,
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
        $subjects = Subject::where('status', 1)->orderBy('order')->get();
        return view('dashboard.topics.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTopicRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTopicRequest $request): RedirectResponse
    {
        Topic::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('topics.index', $request->query())
            ->with('message', 'The topic has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @param Request $request
     * @return View
     */
    public function show(Topic $topic, Request $request): View
    {
        $subjects = Subject::where('status', 1)->orderBy('order')->get();

        return view('dashboard.topics.show', [
            'topic' => $topic,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Topic $topic
     * @param Request $request
     * @return View
     */
    public function edit(Topic $topic, Request $request): View
    {
        $subjects = Subject::where('status', 1)
            ->orWhere('id', $topic->subject_id)
            ->orderBy('order')
            ->get();

        return view('dashboard.topics.edit', [
            'topic' => $topic,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTopicRequest $request
     * @param  Topic $topic
     * @return RedirectResponse
     */
    public function update(UpdateTopicRequest $request, Topic $topic): RedirectResponse
    {
        $topic->update($request->validated());

        return redirect()->route('topics.index', $request->query())
            ->with('message', 'The topic has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Topic $topic
     * @return Request $request
     * @return RedirectResponse
     */
    public function destroy(Topic $topic, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');

        // if ($topic->questions()->exists()) {
        //     return redirect()->route('topics.index', ['page' => $request->input('page', 1)])
        //         ->with('error', 'Cannot delete this topic as it has one or more associated questions.');
        // }

        $topic->delete();

        return redirect()->route('topics.index', $filters)
            ->with('message', "The topic has been deleted successfully.");
    }
}
