<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResources([
    'tasks' => 'Api\TaskController',
    'users' => 'Api\UserController'
]);

Route::get('projects', 'Api\ProjectController@index')->name('project.index');
Route::put('tasks/timer/{task}', 'Api\TaskController@toggleTimer')->name('task.start');
