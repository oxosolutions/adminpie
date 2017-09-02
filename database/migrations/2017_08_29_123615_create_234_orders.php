<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create234Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('234_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('name');
            $table->text('description')->nullable();
            $table->string('cost')->nullable();
            $table->string('quantity')->nullable();
            $table->integer('status')->default(0);
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
        Schema::drop('234_orders');
    }
}
