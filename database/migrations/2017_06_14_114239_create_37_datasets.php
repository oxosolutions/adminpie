<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create37Datasets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('37_datasets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dataset_name');
            $table->string('description');
            $table->string('datatset_table');
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
        Schema::drop('37_datasets');
    }
}
