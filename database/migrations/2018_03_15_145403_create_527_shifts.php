<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create527Shifts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('527_shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('from');
            $table->string('to');
            $table->string('working_days')->default("[]");
            $table->integer('status')->default(1);
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
        Schema::drop('527_shifts');
    }
}