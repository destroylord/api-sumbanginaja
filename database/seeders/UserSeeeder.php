<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Bintang Putera',
            'email' => 'sangbintang917@gmail.com',
            'email_verified_at' => "2021-06-15 10:09:27",
            'password' => Hash::make('tes123'),
            'profile_users' => 'tes',
            'no_handphone' => '123',
            'address' => 'bondowoso',
            'type' => 'default'
        ]);

        DB::table('users')->insert([
            'name' => 'Ibnu Batutah',
            'email' => 'ibnubatutah@gmail.com',
            'email_verified_at' => "2021-06-15 10:09:27",
            'password' => Hash::make('tes123'),
            'profile_users' => 'tes',
            'no_handphone' => '123',
            'address' => 'bondowoso',
            'type' => 'oauth'
        ]);
    }
}
