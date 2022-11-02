<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DeliveryManSeeder extends Seeder
{


    public function run()
    {
        DB::table('delivery_men')->delete();

        DB::table('delivery_men')->insert([
            'name' => 'DeliveryMan',
            'email' => 'DeliveryMan@gmail.com',
            'phone' => '01139405600',
            'password' => Hash::make('DeliveryMan@gmail.com'),
            'birthdate' => '22/2/1999',
            'toolBackLicenceImage' => 'ssss.png',
            'toolFrontLicenceImage' => 'ddd.png',
            'toolType_id' => '1',
            'nationalityFrontIdImage' => 'aaa.png',
            'nationalityBackIdImage' => 'bbb.png',
            'profileImage' => 'hhh.png',
            'state_id' => '1',
            'active' => true,
            'working' => true,
            'type' => true,
            'lat' => '43555.4444',
            'long' => '344.444',
            'wallet' => '3000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }


}
