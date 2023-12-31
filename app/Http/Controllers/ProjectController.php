<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;


//model
use App\Models\Project;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //aggiungo type per poterlo trovare in pagina
        $types = Type::all();
        return view('projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->all();

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->creation_date = $data['creation_date'];
        $newProject->url = $data['url'];
        $newProject->thumb = $data['thumb'];
        $newProject->description = $data['description'];
        $newProject->type_id = $data['type_id'];
        $newProject->is_online = $data['is_online'];
        $newProject->save();

        return redirect()->route('admin.projects.index', compact('newProject'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        $types = Type::all();

        return view('projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $data = $request->all();

        $editProject = Project::findOrFail($id);
        $editProject->title = $data['title'];
        $editProject->creation_date = $data['creation_date'];
        $editProject->url = $data['url'];
        $editProject->thumb = $data['thumb'];
        $editProject->description = $data['description'];
        $editProject->type_id = $data['type_id'];
        $editProject->is_online = $data['is_online'];
        $editProject->save();

        return redirect()->route('admin.projects.index', compact('editProject'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}