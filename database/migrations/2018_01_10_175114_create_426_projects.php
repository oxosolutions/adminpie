<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create426Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('426_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('category')->nullable();
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
        Schema::drop('426_projects');
    }
}
