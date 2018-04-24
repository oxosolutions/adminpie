<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create543Sliders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('543_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('name');
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->text('slider');
            $table->text('options')->nullable();
            $table->text('setting');
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
        Schema::drop('543_sliders');
    }
}
