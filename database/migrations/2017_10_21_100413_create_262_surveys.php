<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create262Surveys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('262_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('survey_table');
            $table->string('name')->nullable();
            $table->string('created_by')->nullable();
            $table->text('description');
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
        Schema::drop('262_surveys');
    }
}
