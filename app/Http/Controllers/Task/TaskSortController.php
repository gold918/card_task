<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;

class TaskSortController extends Controller
{
    /**
     * @param int $id
     * @param string $status
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function sortStatus (int $id, string $status) {
        if(str_contains($status, '-')) {
            $status = 'In progress';
        } else {
            $status = ucfirst($status);
        }

        $project = Auth::user()->projects()->find($id);
        if(isset($project)) {
            $tasks = $project->tasks()->where('status', $status)->get();
            if(view()->exists('site.task.sort')) {
                return view('site.task.sort', compact('project', 'tasks'));
            }
        }
        return abort(404);
    }
}
