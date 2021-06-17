<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Get all the community attaching up to 3 random community to each user
        $community = Community::all();

        // Populate the pivot table
        User::all()->each(function ($user) use ($community) { 
            $user->communities()->attach(
                $community->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
