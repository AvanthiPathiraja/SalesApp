<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id();
            $table->string('number',15);
            $table->string('name',100);
            $table->string('contacted_person',75) ->nullable();
            $table->string('telephone',10);
            $table->string('mobile',10) ->nullable();
            $table->unsignedBigInteger('route_id') ->nullable();
            $table->string('address',255);
            $table->string('email',100) ->nullable();
            $table->string('note',150) ->nullable();
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
        Schema::dropIfExists('customers');
    }
}
