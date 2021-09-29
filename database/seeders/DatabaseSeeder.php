<?php

namespace Database\Seeders;

use App\Models\Route;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{



    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Customer::truncate();
        Route::truncate();


        Route::factory(100)->create();
         Customer::factory(1000)->create();

         Schema::enableForeignKeyConstraints();

    }
}
