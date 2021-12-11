<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableProductImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add table product image
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_init')->default(0);
            $table->bigInteger('product_id')->default(0);
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
        Schema::dropIfExists('product_images');
    }
}
