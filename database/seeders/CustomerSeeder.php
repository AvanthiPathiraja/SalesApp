<?php

namespace Database\Seeders;

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{

    public function run()
    {
        // DB::table('customers')->insert([
        //     'number' => Str::random(15),
        //     'name' => Str::random(100),
        //     'contacted_person' => Str::random(75),
        //     'telephone' => PhoneNumber::random(10),
        //     'address' => Str::random(255),
        //     'email' => Str::random(10).'@gmail.com',

        // ]);
    }
}
