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

// タイマー切り替え
Route::put('tasks/timer/{task}', 'Api\TaskController@toggleTimer')->name('task.start');
// 複数削除
Route::delete('tasks/deletes/{taskIds}', 'Api\TaskController@deletes')->name('task.deletes');

Route::get('projects', 'Api\ProjectController@index')->name('project.index');
Route::get('auth', 'Api\AuthController@index')->name('auth.index');
