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
    Route::get('/', 'HomeController@index');

    Route::get('tasks', function () {
        return view('task');
    });

    Route::resources([
        'projects' => 'ProjectController',
        'users' => 'UserController'
    ]);
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
