<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create433Salaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('433_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->integer('user_id');
            $table->integer('payscale_id');
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->text('payscale')->nullable();
            $table->string('shift')->nullable();
            $table->string('year');
            $table->string('month');
            $table->string('week')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('no_of_leave')->nullable();
            $table->string('monthly_weekly')->nullable();
            $table->integer('number_of_attendance')->nullable();
            $table->string('hours')->nullable();
            $table->string('over_time')->nullable();
            $table->string('short_hours')->nullable();
            $table->decimal('per_day_amount', 10, 2)->nullable();
            $table->integer('total_days')->nullable();
            $table->integer('lock');
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
        Schema::drop('433_salaries');
    }
}
