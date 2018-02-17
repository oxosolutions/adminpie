<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create491Campaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('491_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('campaign_name');
            $table->text('campaign_desc')->nullable();
            $table->text('send_to');
            $table->text('selected_users');
            $table->integer('layout');
            $table->integer('template');
            $table->text('send_to_users');
            $table->boolean('scheduled')->default(0);
            $table->dateTime('exec_time')->nullable();
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
        Schema::drop('491_campaigns');
    }
}
