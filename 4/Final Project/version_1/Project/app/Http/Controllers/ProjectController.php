<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function allProjectTitles()
    {
        $projects = Project::latest()->with('manager')->paginate(10);
        return view('projects.titles', compact('projects'));
    }

    public function allProjectProgress()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.progress', compact('projects'));
    }

    public function show($id) {
        $project = Project::with(['client', 'manager'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }



    public function manageProjects(Request $request)
    {
        $query = Project::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.$request->title.'%');
        }
        if ($request->filled('client_name')) {
            $query->whereHas('client', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->client_name.'%');
            });
        }
        if ($request->filled('manager_name')) {
            $query->whereHas('manager', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->manager_name.'%');
            });
        }

        $projects = $query->orderBy('id','desc')->paginate(20)
                      ->appends($request->only(['id','title','client_name','manager_name']));

        return view('dashboard.manage-projects.index', compact('projects'));
    }



    public function create()
    {
        return view('dashboard.manage-projects.create');
    }

    public function store(Request $request)
    {

    }



    public function edit()
    {
        return view('dashboard.manage-projects.edit');
    }

    public function update(Request $request, Project $project)
    {

    }



    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'پروژه مورد نظر حذف شد.');
    }
}
