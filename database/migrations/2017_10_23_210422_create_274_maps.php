<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create274Maps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('274_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_code');
            $table->string('code');
            $table->string('code_albha_2');
            $table->string('code_albha_3');
            $table->string('code_numeric');
            $table->integer('parent');
            $table->string('title');
            $table->text('description');
            $table->longText('map_data');
            $table->boolean('status');
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
        Schema::drop('274_maps');
    }
}
