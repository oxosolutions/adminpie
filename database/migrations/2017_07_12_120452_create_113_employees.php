<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create113Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('113_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('employee_id');
            $table->text('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('experience')->nullable();
            $table->string('blood_group')->nullable();
            $table->dateTime('joining_date')->nullable();
            $table->string('disability_percentage')->nullable();
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
        Schema::drop('113_employees');
    }
}
