<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create500AppFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('500_app_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->string('name');
            $table->string('mobile');
            $table->string('department');
            $table->text('message');
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
        Schema::drop('500_app_feedback');
    }
}
