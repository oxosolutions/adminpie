<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create435SupportTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('435_support_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('user_id');
            $table->string('subject');
            $table->text('description');
            $table->string('classification')->nullable();
            $table->text('attachment')->nullable();
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
        Schema::drop('435_support_tickets');
    }
}
