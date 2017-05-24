<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create31Attendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('31_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('date');
            $table->string('month');
            $table->string('year');
            $table->string('day')->nullable();
            $table->integer('month_week_no')->nullable();
            $table->string(' import_raw_data')->nullable();
            $table->string(' in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->string('total_hour')->nullable();
            $table->string('actual_hour')->nullable();
            $table->string('over_time')->nullable();
            $table->string('due_time')->nullable();
            $table->string('check_in_by_emoloyee')->nullable();
            $table->string('check_out_by_emoloyee')->nullable();
            $table->string('total_hour_by_emoloyee')->nullable();
            $table->string('actual_hour_by_emoloyee')->nullable();
            $table->string('over_time_by_emoloyee')->nullable();
            $table->string('due_time_by_emoloyee')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('attendance_status')->nullable();
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
        Schema::drop('31_attendances');
    }
}
