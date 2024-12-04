<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use App\Models\Client;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Task', ['tasks' => Task::with(['client:id,company_name', 'project:id,title'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Task/Create', ['clients' => Client::select('id', 'company_name')->get(), 'projects' => Project::select('id', 'title')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretaskRequest $request)
    {
        Task::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        $this->authorize('edit', $task);
        return inertia('Task/Edit', ['task' => $task->load(['client:id,company_name', 'project:id,title'])]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetaskRequest $request, task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        if (auth()->user()->hasRole('admin')) {
            $task->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
