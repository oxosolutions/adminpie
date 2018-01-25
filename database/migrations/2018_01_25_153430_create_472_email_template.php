<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create472EmailTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('472_email_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('content');
            $table->string('subject');
            $table->integer('status');
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
        Schema::drop('472_email_template');
    }
}
