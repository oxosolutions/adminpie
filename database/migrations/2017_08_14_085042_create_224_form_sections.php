<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create224FormSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('224_form_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->string('section_name');
            $table->text('section_slug');
            $table->text('section_description');
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
        Schema::drop('224_form_sections');
    }
}
