<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create502MenuSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('502_menu_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->string('key');
            $table->text('value')->nullable();
            $table->integer('order');
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
        Schema::drop('502_menu_settings');
    }
}
