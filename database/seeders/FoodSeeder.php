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
        $json_province = \Illuminate\Support\Facades\File::get("database/data/province.json");
        $provinces =  json_decode($json_province, true);

        foreach ($provinces as $key => $value) {
            Province::create([
                "name" => $value['name'],
            ]);
        }
        // City
        $json = \Illuminate\Support\Facades\File::get("database/data/city.json");
        $cities =  json_decode($json, true);

        foreach ($cities as $key => $value) {
            City::create([
                "name" => $value['name'],
                "province_id" => $value['province_id']
            ]);
        }

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
