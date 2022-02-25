<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'department_id' => 1,
            'phone_number' => 2547089456,
            'is_id' => 1,
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
