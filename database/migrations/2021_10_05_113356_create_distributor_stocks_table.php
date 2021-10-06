<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('issue_note_id'); //should check
            $table->unsignedBigInteger('distributor_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('stock_id');
            $table->smallInteger('quantity');
            $table->boolean('is_checked_and_returned')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_stocks');
    }
}
