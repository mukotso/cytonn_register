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
Route::delete('user/{user}', 'UsersController@destroy');

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


// events
Route::get('events', 'EventsController@index');
Route::post('event', 'EventsController@store');
Route::put('event/{event}', 'EventsController@update');
Route::get('event/{event}', 'EventsController@show');
Route::get('event/{event}/edit', 'EventsController@edit');
Route::delete('event/{event}', 'EventsController@destroy');

//team members
Route::get('event/remove-team-member/{eventTeamMember}', 'EventTeamMembersController@destroy');

//event activities
Route::get('event/remove-activity/{activity}', 'EventActivitiesController@destroy');
Route::get('event/complete-activity/{activity}', 'EventActivitiesController@complete');
Route::get('event/activity-not-happening/{activity}', 'EventActivitiesController@activityNotHappening');


//event frequencies
Route::get('frequencies', 'FrequenciesController@index');


//Profile Page
Route::get('profile', 'UserProfileController@index');
Route::post('profile/update-password', 'UserProfileController@updatePassword');
