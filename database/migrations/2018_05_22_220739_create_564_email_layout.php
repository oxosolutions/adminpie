<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create564EmailLayout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('564_email_layout', function (Blueprint $table) {
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
        Schema::drop('564_email_layout');
    }
}
