<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create311Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('311_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->string('type');
            $table->integer('parent_id')->nullable();
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
        Schema::drop('311_categories');
    }
}