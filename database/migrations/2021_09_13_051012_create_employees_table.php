<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('number',15);
            $table->string('title',10);
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->date('date_of_birth');
            $table->string('nic_number',12);
            $table->string('driving_lisence_number',20) ->nullable();
            $table->string('telephone',10);
            $table->string('mobile',10) ->nullable();
            $table->string('address');
            $table->string('email',100) ->nullable();
            $table->string('designation',30)->nullable();
            $table->boolean('is_active') ->default('1');
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
        Schema::dropIfExists('employees');
    }
}
