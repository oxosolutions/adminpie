<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create497Document extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('497_document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('layout');
            $table->integer('template');
            $table->longtext('document_content');
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
        Schema::drop('497_document');
    }
}
