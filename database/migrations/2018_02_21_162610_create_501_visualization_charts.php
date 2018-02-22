<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create501VisualizationCharts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('501_visualization_charts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visualization_id');
            $table->text('chart_title');
            $table->string('primary_column');
            $table->text('secondary_column');
            $table->string('chart_type');
            $table->string('status');
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
        Schema::drop('501_visualization_charts');
    }
}
