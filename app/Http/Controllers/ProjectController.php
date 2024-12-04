<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return inertia('Project', ['projects' => Project::all()]);
        return inertia('Project', ['projects' => Project::with(['client:id,company_name'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Project/Create', ['clients' => Client::select('id', 'company_name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return inertia('Project', ['projects' => $project->load('client')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('edit', $project);
        // $project->load('client') => Eager load the related client (or any other relationships)
        return inertia('Project/Edit', ['project' => $project->load('client')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if (auth()->user()->hasRole('admin')) {
            $project->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
