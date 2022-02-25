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
Route::get('users/{user}', 'UsersController@show');
Route::post('users/create', 'UsersController@store');
Route::put('users/update/{user}', 'UsersController@update');
Route::delete('users/delete/{user}', 'UsersController@destroy');

//departments
Route::get('departments', 'DepartmentsController@index');
Route::post('departments/create', 'DepartmentsController@store');
Route::put('departments/update/{department}', 'DepartmentsController@update');
Route::delete('departments/delete/{department}', 'DepartmentsController@destroy');

//categories
Route::get('categories', 'CategoriesController@index');
Route::get('categories/{category}', 'CategoriesController@show');
Route::post('categories/create', 'CategoriesController@store');
Route::put('categories/update/{category}', 'CategoriesController@update');
Route::delete('categories/delete/{category}', 'CategoriesController@destroy');


