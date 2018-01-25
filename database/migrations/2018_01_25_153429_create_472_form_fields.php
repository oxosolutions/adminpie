<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create472FormFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('472_form_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field_slug')->nullable();
            $table->integer('form_id');
            $table->integer('section_id');
            $table->string('field_title');
            $table->string('field_type')->nullable();
            $table->text('field_description');
            $table->integer('order')->nullable();
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
        Schema::drop('472_form_fields');
    }
}
