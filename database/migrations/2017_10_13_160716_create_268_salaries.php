<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create268Salaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('268_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->integer('payscale_id');
            $table->string('year');
            $table->string('month');
            $table->string('week')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('no_of_leave');
            $table->string('payscale');
            $table->integer('lock');
            $table->string('monthly_weekly');
            $table->integer('status')->default(1);
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
        Schema::drop('268_salaries');
    }
}
