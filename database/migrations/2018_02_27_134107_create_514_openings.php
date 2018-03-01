<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create514Openings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('514_openings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('minimum_qualification')->nullable();
            $table->string('eligiblity')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('skills')->nullable();
            $table->string('job_type')->nullable();
            $table->string('location')->nullable();
            $table->string('number_of_post')->nullable();
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
        Schema::drop('514_openings');
    }
}
