<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', ['uses' => 'Project\ProjectController@index', 'as' => 'project']);
    Route::get('/project/create', ['uses' => 'Project\ProjectController@create', 'as' => 'project.create']);
    Route::post('/project/create', ['uses' => 'Project\ProjectController@store', 'as' => 'project.store']);
    Route::get('/project/update/{id}', ['uses' => 'Project\ProjectController@edit', 'as' => 'project.update']);
    Route::put('/project/update/{id}', ['uses' => 'Project\ProjectController@update', 'as' => 'project.update']);
    Route::delete('/project/delete/{id}', ['uses' => 'Project\ProjectController@destroy', 'as' => 'project.delete']);

    Route::prefix('/project/{id}/tasks')->group(function () {
        Route::get('/', ['uses' => 'Project\ProjectController@show', 'as' => 'task']);
        Route::get('/create', ['uses' => 'Task\TaskController@create', 'as' => 'task.create']);
        Route::post('/create', ['uses' => 'Task\TaskController@store', 'as' => 'task.store']);
        Route::get('/update/{taskId}', ['uses' => 'Task\TaskController@edit', 'as' => 'task.update']);
        Route::put('/update/{taskId}', ['uses' => 'Task\TaskController@update', 'as' => 'task.update']);
        Route::delete('/delete/{taskId}', ['uses' => 'Task\TaskController@destroy', 'as' => 'task.delete']);
        Route::get('/single/{taskId}', ['uses' => 'Task\TaskController@show', 'as' => 'task.show']);
        Route::get('/sort/status/{status}', ['uses' => 'Task\TaskSortController@sortStatus', 'as' => 'task.sort.status']);
        Route::get('/user/update', ['uses' => 'Task\TaskUserController@edit', 'as' => 'task.user.edit']);
        Route::patch('/user/update', ['uses' => 'Task\TaskUserController@update', 'as' => 'task.user.update']);
    });
});

Route::get('/home', 'HomeController@index')->name('home');
