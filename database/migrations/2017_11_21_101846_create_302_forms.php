<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create302Forms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('302_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_title');
            $table->string('form_slug');
            $table->text('form_description');
            $table->string('type');
            $table->text('embed_token');
            $table->integer('form_order');
            $table->string('form_status');
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
        Schema::drop('302_forms');
    }
}
