<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create452EmailLayout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('452_email_layout', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('header');
            $table->text('footer');
            $table->integer('order');
            $table->string('slug');
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
        Schema::drop('452_email_layout');
    }
}
