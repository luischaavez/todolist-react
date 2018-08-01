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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/todos', 'TodosController@store')
    ->name('todos.store')
    ->middleware('auth');

Route::put('/todos/{todo}', 'TodosController@update')
    ->name('todos.update')
    ->middleware('auth');
    
Route::delete('/todos/{todo}', 'TodosController@destroy')
    ->name('todos.destroy')
    ->middleware('auth');

Route::get('todos/{todo}/complete', 'CompleteTodoController')
    ->name('todos.complete');
    