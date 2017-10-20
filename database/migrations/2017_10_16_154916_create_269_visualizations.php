<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create269Visualizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('269_visualizations', function (Blueprint $table) {
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
        Schema::drop('269_visualizations');
    }
}
