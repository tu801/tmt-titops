<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add table order
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_init')->default(0)->index();
            $table->string('code', 255);
            $table->float('total');
            $table->enum('status', ['pending','processing','completed','decline'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->index();
            $table->bigInteger('product_id')->default(0)->index();
            $table->float('price');
            $table->integer('quantity');
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
        //remove tables
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_item');
    }
}
