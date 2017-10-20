<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create274Visualizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('274_visualizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dataset_id');
            $table->string('name');
            $table->text('description');
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
        Schema::drop('274_visualizations');
    }
}
