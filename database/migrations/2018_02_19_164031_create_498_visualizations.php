<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create498Visualizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('498_visualizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dataset_id');
            $table->string('name');
            $table->text('description');
            $table->string('embed_token');
            $table->string('created_by');
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
        Schema::drop('498_visualizations');
    }
}
