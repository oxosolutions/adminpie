<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create235Leaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('235_leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('employee_id');
            $table->string('reason_of_leave')->nullable();
            $table->integer('leave_category_id');
            $table->date('from');
            $table->date('to');
            $table->text('description')->nullable();
            $table->integer('total_days')->nullable();
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
        Schema::drop('235_leaves');
    }
}
