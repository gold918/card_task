<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Project;

class TaskUserController extends Controller
{
    public function edit ($id) {
        $project = Auth::user()->projects()->find($id);
        if(isset($project) && view()->exists('site.task.user_update')) {
            $users = User::pluck('name')->all();
            $teamAll = $project->users()->pluck('name')->all();
            $creator = $teamAll[0];
            $team =  array_slice($teamAll, 1);
            $usersNotTeam = array_diff($users, $teamAll);

            return view('site.task.user_update', compact([
                                                                'id',
                                                                'users',
                                                                'creator',
                                                                'team',
                                                                'usersNotTeam',
                                                                                ]));
        }
        return abort(404);
    }

    public function update (Request $request, $id) {
        $project = Auth::user()->projects()->find($id);
        if($request->has('users')) {
            foreach ($request->users as $name) {
                $user = User::where('name', $name)->first();
                $project->users()->attach($user);
            }
        }
        return redirect()->route('task', ['id' => $id]);
    }
}
