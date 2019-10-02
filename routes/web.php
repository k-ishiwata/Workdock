<?php

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

Route::group(['middleware' => 'auth'], function()
{
//    Route::get('/', 'HomeController@index');
    Route::redirect('/', 'tasks', 301);

    Route::get('tasks', function () {
        return view('task');
    });

    Route::resource('projects', 'ProjectController');
    Route::resource('reports', 'ReportController')->except([
        'show'
    ]);

    Route::get('reports/{user}/{year?}/{month?}/{day?}', 'ReportController@show')
        ->where([
            'year' => '\d{4}',
            'month' => '\d{2}',
            'day' => '\d{2}'
        ])
        ->name('reports.show');


    // 管理者のみアクセス可能
    Route::group(['middleware' => ['can:admin']], function () {
        Route::resource('users', 'UserController');
    });
});


Auth::routes();
