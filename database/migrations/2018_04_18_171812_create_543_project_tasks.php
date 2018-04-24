<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create543ProjectTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('543_project_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('priority')->default("low");
            $table->text('attachment')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by');
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
        Schema::drop('543_project_tasks');
    }
}
