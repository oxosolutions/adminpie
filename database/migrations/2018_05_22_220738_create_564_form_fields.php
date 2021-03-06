<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create564FormFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('564_form_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field_slug')->nullable();
            $table->integer('form_id');
            $table->integer('section_id');
            $table->text('field_title');
            $table->string('field_type')->nullable();
            $table->text('field_description')->nullable();
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
        Schema::drop('564_form_fields');
    }
}
