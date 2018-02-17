<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create491Bookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('491_bookmarks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('link');
            $table->string('target');
            $table->string('user_id');
            $table->string('categories');
            $table->string('tags');
            $table->integer('order');
            $table->integer('status');
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
        Schema::drop('491_bookmarks');
    }
}
