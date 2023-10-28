<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $attributes = [
        'title',
        'client_id',
        'start_date',
        'end_date',
        'status',
        'category',
        'team_members',
        'budget',
        'tags',
        'progress',
        'description',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $attributes = [
            'title',
            'status',
            'category',
            'progress'
        ];

        return view('pages.project.index', compact(['projects', 'attributes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.project.create', [
            'attributes' => $this->attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = is_numeric($request->id) ? $request->id : null;

//        $data = $request->validate([
//            'title' => 'required',
//            'description' => 'nullable',
//            'start_date' => 'nullable|date',
//            'end_date' => 'nullable|date',
//        ]);

        // Prepare the data to be used for updating or creating the expense
        $projectData = [];
        foreach ($this->attributes as $attribute){
            $projectData[$attribute] = $request->$attribute;
        }

        // Editing an existing project
        $project = Project::updateOrcreate(['id' => $id], $projectData);
        if (!$project){
            return back()->with('error', 'Failed to ' . ($id ? 'update' : 'create') . ' the project');
        }
        return back()->with('status', 'Project ' . ($id ? 'updated' : 'created') . ' successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        return view('pages.project.show', [
            'project'=>$project,
            'attributes' => $this->attributes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        $project_files = File::where('model_related_to', 'project')->where('model_id', $id)->get();
        return view('pages.project.create', [
            'attributes' => $this->attributes,
            'project' => $project,
            'files' => $project_files
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('projects.index')->with('message', 'Project not found.');
        }
        $project->delete();
        return redirect()->route('projects.index')->with('message', 'Project deleted successfully');
    }
}
