<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create10LeaveRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('10_leave_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('designation_id');
            $table->integer('leave_category_id');
            $table->integer('days');
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
        Schema::drop('10_leave_rules');
    }
}
