<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create304FormFieldMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('304_form_field_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->integer('section_id');
            $table->integer('field_id');
            $table->string('key');
            $table->text('value')->nullable();
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
        Schema::drop('304_form_field_meta');
    }
}
