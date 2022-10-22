<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Food;
use App\Models\Province;
use App\Models\Rating;
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

        // Province
        Province::factory(10)->create();

        // City
        City::factory(10)->create();

        // foods
        Food::factory(10)->create();

        // ratings
        Rating::factory(30)->create();



        $ratings = Food::all();

        // Pivot Table
        Food::all()->each(function ($foods) use ($ratings) {
            $foods->ratings()->attach(
                $ratings->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
