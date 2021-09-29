<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_notes', function (Blueprint $table) {
            $table->id();
            $table->string('number',20);
            $table->string('reference',15)->nullable();
            $table->date('date');
            $table->unsignedBigInteger('distributor_id');
            $table->boolean('is_active')->default('1');
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
        Schema::dropIfExists('issue_notes');
    }
}
