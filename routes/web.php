<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::middleware('auth')->group(function () {
    Route::resource('users','UsersController');
    Route::resource('departments','DepartmentsController');
    Route::resource('categories','CategoriesController');
    Route::resource('events','EventsController');
    Route::resource('profile', 'UserProfileController');

    Route::get('frequencies', 'FrequenciesController@index');
    Route::post('profile/update-password', 'UserProfileController@updatePassword');

    Route::get('event/remove-team-member/{eventTeamMember}', 'EventTeamMembersController@destroy');
    Route::get('event/remove-activity/{activity}', 'EventActivitiesController@destroy');
    Route::get('event/complete-activity/{activity}', 'EventActivitiesController@complete');
    Route::get('event/activity-not-happening/{activity}', 'EventActivitiesController@activityNotHappening');
//    });
