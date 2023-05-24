<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// viewの確認用routes
Route::get('/bookmark', function() {
    return view('bookmark');
});

Route::get('/create', function() {
    return view('create');
});

Route::get('/profile', function() {
    return view('profile');
});

Route::get('/show', function() {
    return view('show');
});

Route::get('/edit', function() {
    return view('edit');
});






Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ブックマーク機能
Route::get('bookmark/{task_id}','BookmarkController@store');

Route::get('{bookmark_id}/bookmark','BookmarkController@destroy');



Route::get('/tasks','TaskController@index')->name('tasks.index');

Route::get('/tasks/create','TaskController@create')->name('tasks.create');

Route::post('/tasks','TaskController@store')->name('tasks.store');

Route::get('/tasks/{id}/edit','TaskController@edit')->name('tasks.edit');

Route::get('/tasks/{id}','TaskController@show')->name('tasks.show');

Route::put('/task/{id}','TaskController@update')->name('tasks.update');

Route::delete('/tasks/{id}','TaskController@destroy')->name('tasks.destroy');