<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frequencies')->insert([
            'name' => 'one time',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('frequencies')->insert([
            'name' => 'daily',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('frequencies')->insert([
            'name' => 'weekly',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('frequencies')->insert([
            'name' => 'bi-weekly',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('frequencies')->insert([
            'name' => 'monthly',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('frequencies')->insert([
            'name' => 'bi-monthly',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('frequencies')->insert([
            'name' => 'annualy',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
