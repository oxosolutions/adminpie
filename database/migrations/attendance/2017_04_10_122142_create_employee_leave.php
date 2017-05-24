<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('employee_leaves',function(Blueprint $table)
       {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('total_day_of_leave');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('reason_of_leave')->nullable();
            $table->string('description')->nullable();
            $table->integer('approved_status')->default(0);
            $table->timestamps();
            $table->softDeletes();

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leaves');
    }
}
