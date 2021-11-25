<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 2000; $i++) {
            $array = [];
            for ($j = 0; $j < 500; $j++) {
                $array[] = [
                    'login' => Str::random(6),
                    'name' => Str::random(8),
                    'email' => Str::random(6) . '@gmail.com',
                    'address' => Str::random(10),
                    'occupation' => Str::random(10),
                    'skill' => Str::random(8),
                    'school' => Str::random(8),
                    'degree' => Str::random(10),
                    'food' => Str::random(10),
                    'color' => Str::random(6),
                ];
            }
            DB::table('data')->insert($array);
        }
        //Data::factory()->count(1000000)->create();
    }
}
