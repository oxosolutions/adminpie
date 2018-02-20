<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create499MenuItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('499_menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('link');
            $table->integer('parent')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->string('target')->nullable();
            $table->integer('menu');
            $table->integer('depth')->default(0);
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
        Schema::drop('499_menu_items');
    }
}
