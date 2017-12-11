<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create314DocumentTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('314_document_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('content')->nullable();
            $table->string('subject')->nullable();
            $table->string('slug');
            $table->integer('status');
            $table->integer('order');
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
        Schema::drop('314_document_template');
    }
}
