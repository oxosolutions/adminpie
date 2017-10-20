<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create259MenuItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('259_menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->string('title')->nullable();
            $table->string('class')->nullable();
            $table->string('title_attribute')->nullable();
            $table->string('link')->nullable();
            $table->string('target')->nullable();
            $table->string('type')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('order')->nullable();
            $table->string('icon')->nullable();
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
        Schema::drop('259_menu_items');
    }
}
