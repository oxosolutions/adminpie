<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create112Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('112_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('student_id')->nullable();
            $table->string('dob')->nullable();
            $table->string(' qualification')->nullable();
            $table->string('college_university')->nullable();
            $table->dateTime('joining_date')->nullable();
            $table->integer('status')->default(0);
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
        Schema::drop('112_students');
    }
}
