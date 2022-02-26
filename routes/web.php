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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//users
Route::get('users', 'UsersController@index');
Route::post('user', 'UsersController@store');
Route::put('user/{user}', 'UsersController@update');
Route::delete('users/{user}', 'UsersController@destroy');

//departments
Route::get('departments', 'DepartmentsController@index')->name('departments.index');
Route::post('department', 'DepartmentsController@store');
Route::put('department/{department}', 'DepartmentsController@update');
Route::delete('department/{department}', 'DepartmentsController@destroy');

// event categories
Route::get('categories', 'CategoriesController@index');
Route::post('category', 'CategoriesController@store');
Route::put('category/{category}', 'CategoriesController@update');
Route::delete('category/{category}', 'CategoriesController@destroy');


