<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create424Teams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('424_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('member_ids')->nullable();
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
        Schema::drop('424_teams');
    }
}
