<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create241Forms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('241_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_title');
            $table->string('form_slug');
            $table->text('form_description');
            $table->string('type');
            $table->integer('order');
            $table->string('status');
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
        Schema::drop('241_forms');
    }
}
