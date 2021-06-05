<?php

use Illuminate\Database\Seeder;
use App\Project;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::all();
        $project->each(function ($project) {
            $project->tasks()->saveMany(factory(\App\Task::class, 5)->make());
        });
    }
}
