<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Auth::user()->projects->pluck('title', 'id')->all();
        if(view()->exists('site.project.index')) {
            return view('site.project.index', compact('projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(view()->exists('site.project.create')) {
            return view('site.project.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        try {
            if($request->has('title')) {
                $project->title = $request->title;
            }
           $project = Auth::user()->projects()->save($project);
            return redirect()->route('task', ['id' => $project->id]);
        } catch (\Exception $e) {
            return back()->withErrors(['inform' => 'Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Auth::user()->projects()->find($id);
        if(isset($project)) {
            $tasks = $project->tasks;
            if(view()->exists('site.task.index')) {
                return view('site.task.index', compact('project', 'tasks'));
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        if(view()->exists('site.project.update')) {
            return view('site.project.update', compact('project'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
        ]);
        $project = Project::find($id);
        try {
            if($request->has('title')) {
                $project->title = $request->title;
            }
            $project->save();
            return redirect()->route('project');
        } catch (\Exception $e) {
            return back()->withErrors(['inform' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if(isset($project->tasks)) {
            $project->tasks()->delete();
            foreach ($project->tasks as $task) {
                $task->removeFile();
            }
        }
        $project->users()->detach();
        return redirect()->route('project');
    }
}
