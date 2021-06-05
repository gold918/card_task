<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Project;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        $project = Auth::user()->projects()->find($id);
        if(isset($project) && view()->exists('site.task.create')) {
            return view('site.task.create', compact('project'));
        }
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'preview' => 'required|string',
            'text' => 'required|string',
        ]);

        $project = Auth::user()->projects()->find($id);

        try {
            if($request->has('title', 'preview', 'text')) {
                $task->fill($request->all());
                $task->uploadFile($request->file);
            }
            $project->tasks()->save($task);

            return redirect()->route('task', ['id' => $id]);
        } catch (\Exception $e) {
            return back()->withErrors(['inform' => 'Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, int $taskId)
    {
        $project = Auth::user()->projects()->find($id);
        $task = Task::find($taskId);
        if(isset($project) && view()->exists('site.task.single')) {

            return view('site.task.single', compact('task'));
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $taskId)
    {
        $project = Auth::user()->projects()->find($id);
        $task = Task::find($taskId);
        if(isset($project) && view()->exists('site.task.update')) {
            return view('site.task.update', compact('project', 'task'));
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $taskId)
    {
        $request->validate([
            'title' => 'required|string',
            'preview' => 'required|string',
            'text' => 'required|string',
        ]);

        $task = Task::find($taskId);

        try {
            if($request->has('title', 'preview', 'text')) {
                $task->uploadFile($request->file);
                $task->fill($request->all());
            }
            $task->save();

            return redirect()->route('task', ['id' => $id]);
        } catch (\Exception $e) {
            return back()->withErrors(['inform' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $taskId)
    {
        try {
            $task = Task::find($taskId);
            $task->delete();
            $task->removeFile();
            return redirect()->route('task', ['id' => $id]);
        } catch (\Exception $e) {
            return back()->withErrors(['inform' => 'Error']);
        }
    }
}
