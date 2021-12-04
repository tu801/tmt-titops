<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add product table
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedDecimal('price', 8, 2)->default(0.0);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->text('description')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();
        });

        Schema::create('product_brand', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remove tables
        Schema::dropIfExists('product');
        Schema::dropIfExists('product_brand');
    }
}
