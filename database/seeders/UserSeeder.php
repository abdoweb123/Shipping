<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{


    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '01239405600',
            'state_id' => '1',
            'wallet' => '2000',
            'image' => 'effsf.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('user@gmail.com'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }


}
