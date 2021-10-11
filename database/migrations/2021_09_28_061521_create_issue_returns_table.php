<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_returns', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('distributor_id');
            $table->unsignedBigInteger('stock_id');
            $table->smallInteger('quantity');
            $table->string('note',150);
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
        Schema::dropIfExists('issue_returns');
    }
}
