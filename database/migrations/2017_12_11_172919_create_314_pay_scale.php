<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create314PayScale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('314_pay_scale', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('currency')->nullable();
            $table->string('pay_cycle')->nullable();
            $table->decimal('pay_scale', 10, 2)->nullable();
            $table->decimal('basic_pay', 10, 2)->nullable();
            $table->decimal('grade_pay', 10, 2)->nullable();
            $table->decimal('ta', 10, 2)->nullable();
            $table->decimal('da', 10, 2)->nullable();
            $table->decimal('sa', 10, 2)->nullable();
            $table->decimal('hra', 10, 2)->nullable();
            $table->decimal('epf_addiction', 10, 2)->nullable();
            $table->decimal('epf_deducation', 10, 2)->nullable();
            $table->string('sa_details')->nullable();
            $table->decimal('total_salary', 10, 2)->nullable();
            $table->decimal('gross_salary', 10, 2)->nullable();
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
        Schema::drop('314_pay_scale');
    }
}
