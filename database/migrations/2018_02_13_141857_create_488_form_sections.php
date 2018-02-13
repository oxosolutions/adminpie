<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create488FormSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('488_form_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->string('section_name');
            $table->text('section_slug')->nullable();
            $table->text('section_description')->nullable();
            $table->integer('order');
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
        Schema::drop('488_form_sections');
    }
}
