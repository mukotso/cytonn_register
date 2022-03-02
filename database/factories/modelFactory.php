<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'department_id' => 1,
        'phone_number' => $faker->randomDigitNotNull,
        'is_admin' => 0,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});

$factory->define(App\Models\Department::class, function ($faker){
    $name=$this->faker->word;
    return [
        'name'=>$name,
    ];
});

$factory->define(App\Models\Category::class, function ($faker){
    $name=$this->faker->word;
    $description=$this->faker->sentence;
    return [
        'name'=>$name,
        'description'=>$description,
    ];
});

$factory->define(App\Models\Event::class, function (Faker $faker){
    return [
        'category_id'=>function(){
            return  factory('App\Models\Category')->create()->id;
        },
        'user_id'=>function(){
            return  factory('App\Models\User')->create()->id;
        },
        'frequency_id'=>1,
        'name'=>$faker->name,
        'venue'=>$faker->name,
        'start_date'=>$faker->dateTime,
        'event_date'=>$faker->dateTime,
        'lead_time'=>$faker->dateTime,
    ];
});
