<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create310Applications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('310_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicant_id');
            $table->integer('opening_id');
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
        Schema::drop('310_applications');
    }
}
