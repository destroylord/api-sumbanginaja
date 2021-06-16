<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Food::factory(10)->create();
        // DB::table('foods')->insert([
        //     'name' => 'Roti Bakar',
        //     'images' => 'img.jpg',
        //     'descriptions' => 'roti bakar enak sip',
        //     'payback_time' => "2017-08-15 19:30:10"
        // ]);
    }
}
