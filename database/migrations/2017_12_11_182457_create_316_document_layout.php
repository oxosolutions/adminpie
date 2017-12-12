<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create316DocumentLayout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('316_document_layout', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('header')->nullable();
            $table->text('footer')->nullable();
            $table->integer('order');
            $table->string('slug');
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
        Schema::drop('316_document_layout');
    }
}
