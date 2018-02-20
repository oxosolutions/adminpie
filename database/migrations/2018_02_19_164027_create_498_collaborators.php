<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create498Collaborators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('498_collaborators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('relation_id');
            $table->string('email');
            $table->string('userid');
            $table->string('access');
            $table->string('status');
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
        Schema::drop('498_collaborators');
    }
}
