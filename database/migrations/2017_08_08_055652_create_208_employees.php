<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create208Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('208_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('employee_id')->nullable();
            $table->text('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('experience')->nullable();
            $table->string('blood_group')->nullable();
            $table->dateTime('joining_date')->nullable();
            $table->string('disability_percentage')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::drop('208_employees');
    }
}
