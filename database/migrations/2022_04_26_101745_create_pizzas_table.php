<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id('pizza_id');
            $table->string("name");
            $table->string('image');
            $table->integer('price');
            $table->boolean("publish_status");
            $table->integer("category_id");
            $table->integer("discount_price");
            $table->boolean("buy1_get1_status");
            $table->integer("waiting_time");
            $table->text("description");
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
        Schema::dropIfExists('pizzas');
    }
};
