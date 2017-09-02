<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create229Datasets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('229_datasets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dataset_name');
            $table->text('description');
            $table->string('dataset_table');
            $table->string('dataset_file');
            $table->string('dataset_file_name');
            $table->string('user_id');
            $table->string('uploaded_by');
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
        Schema::drop('229_datasets');
    }
}
