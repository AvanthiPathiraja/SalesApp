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
            $table->unsignedBigInteger('issue_note_id');
            $table->date('date');
            $table->unsignedBigInteger('distributor_id');
            $table->unsignedBigInteger('issue_item_id')->nullable();
            $table->unsignedBigInteger('stock_id');
            $table->smallInteger('quantity');
            $table->string('reason',70);
            $table->boolean('is_reusable') ->default('1');
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
