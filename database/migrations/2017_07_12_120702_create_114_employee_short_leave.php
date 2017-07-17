<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create114EmployeeShortLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('114_employee_short_leave', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('reason_of_leave')->nullable();
            $table->text('description')->nullable();
            $table->string('from');
            $table->string('to');
            $table->integer(' approved_status')->default(0);
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
        Schema::drop('114_employee_short_leave');
    }
}
