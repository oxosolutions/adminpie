<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create422SupportComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('422_support_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('comment')->nullable();
            $table->text('attachments')->nullable();
            $table->integer('ticket_id');
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
        Schema::drop('422_support_comments');
    }
}
