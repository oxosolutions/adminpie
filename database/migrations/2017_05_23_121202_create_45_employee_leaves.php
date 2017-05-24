<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create45EmployeeLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('45_employee_leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('reason_of_leave')->nullable();
            $table->text('description')->nullable();
            $table->integer('total_day_of_leave')->nullable();
            $table->date('from');
            $table->date('to');
            $table->integer('approved_status')->default(0);
            $table->string('approved_by')->nullable();
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
        Schema::drop('45_employee_leaves');
    }
}
