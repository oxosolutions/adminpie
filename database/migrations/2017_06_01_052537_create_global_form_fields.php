<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalFormFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_form_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field_slug');
            $table->integer('form_id');
            $table->integer('section_id');
            $table->string('field_title');
            $table->string('type');
            $table->text('field_description')->nullable();
            $table->integer('field_order');
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
        Schema::drop('global_form_fields');
    }
}
