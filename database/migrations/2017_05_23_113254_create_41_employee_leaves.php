<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create41EmployeeLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('41_employee_leaves', function (Blueprint $table) {
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
        Schema::drop('41_employee_leaves');
    }
}
