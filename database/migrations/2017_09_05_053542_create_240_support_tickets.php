<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create240SupportTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('240_support_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('user_id');
            $table->string('title');
            $table->text('description');
            $table->string('type')->nullable();
            $table->string('assign_to')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('priority')->default("low");
            $table->integer('status')->default(0);
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
        Schema::drop('240_support_tickets');
    }
}
