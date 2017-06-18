<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create38Attendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('38_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->integer('user_id')->nullable();
            $table->string('date');
            $table->string('month');
            $table->string('year');
            $table->string('day')->nullable();
            $table->integer('month_week_no')->nullable();
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->string('total_hour')->nullable();
            $table->string('actual_hour')->nullable();
            $table->string('over_time')->nullable();
            $table->string('due_time')->nullable();
            $table->string('import_data')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('attendance_status')->nullable();
            $table->string('submited_by')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('check_for_checkin_checkout')->null();
            $table->timestamp(' deleted_at')->nullable();
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
        Schema::drop('38_attendances');
    }
}
