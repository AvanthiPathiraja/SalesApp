<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('number',20);
            $table->tinyInteger('brand_id') ->nullable();
            $table->string('category',70);
            $table->string('name',100);
            $table->string('unit',15);
            $table->string('metric',20) ->nullable();
            $table->tinyInteger('size') ->nullable();
            $table->smallInteger('minimum_stock') ->nullable();
            $table->decimal('unit_price');
            $table->string('note',150)->nullable();
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
        Schema::dropIfExists('products');
    }
}
