<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create489VisualizationChartMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('489_visualization_chart_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visualization_id');
            $table->integer('chart_id');
            $table->text('key');
            $table->text('value')->nullable();
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
        Schema::drop('489_visualization_chart_meta');
    }
}
