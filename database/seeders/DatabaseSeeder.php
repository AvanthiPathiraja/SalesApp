<?php

namespace Database\Seeders;

use App\Models\Route;
use App\Models\Stock;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DiscardedStock;
use App\Models\Employee;
use App\Models\IssueItem;
use App\Models\IssueNote;
use App\Models\InvoiceItem;
use App\Models\InvoicePayment;
use App\Models\InvoiceReturn;
use App\Models\IssueReturn;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{



    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Customer::truncate();
        Route::truncate();
        Employee::truncate();
        Product::truncate();
        Stock::truncate();
        IssueNote::truncate();
        IssueItem::truncate();
        Invoice::truncate();
        InvoiceItem::truncate();
        InvoicePayment::truncate();
        InvoiceReturn::truncate();
        IssueReturn::truncate();
        DiscardedStock::truncate();


        Route::factory(5)->create();
         Customer::factory(1000)->create();
         Employee::factory(100)->create();
         Product::factory(2000)->create();
        Stock::factory(3000)->create();
        IssueNote::factory(500)->create();
        IssueItem::factory(4200)->create();
        Invoice::factory(4200)->create();
        InvoiceItem::factory(4200)->create();
        InvoicePayment::factory(4200)->create();
        InvoiceReturn::factory(200)->create();
        IssueReturn::factory(500)->create();
        DiscardedStock::factory(50)->create();

         Schema::enableForeignKeyConstraints();

    }
}
