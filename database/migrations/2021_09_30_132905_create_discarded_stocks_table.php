<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscardedStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discarded_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('stock_id');
            $table->smallInteger('quantity');
            $table->string('reason',70);
            $table->string('note',150)->nullable();
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
        Schema::dropIfExists('discarded_stocks');
    }
}
