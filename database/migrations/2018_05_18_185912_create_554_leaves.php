<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create554Leaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('554_leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('employee_id');
            $table->string('type')->nullable();
            $table->string('reason_of_leave')->nullable();
            $table->integer('leave_category_id');
            $table->date('from');
            $table->date('to');
            $table->integer('from_leave_count')->nullable();
            $table->integer('to_leave_count')->nullable();
            $table->text('description')->nullable();
            $table->float('total_days')->nullable();
            $table->string('apply_by');
            $table->string('approved_by')->nullable();
            $table->integer('status');
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
        Schema::drop('554_leaves');
    }
}
