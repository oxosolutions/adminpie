<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create427SupportComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('427_support_comments', function (Blueprint $table) {
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
        Schema::drop('427_support_comments');
    }
}
