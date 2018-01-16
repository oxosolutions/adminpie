<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create452EmailTemplateMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('452_email_template_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->text('value');
            $table->integer('template_id');
            $table->string('type');
            $table->integer('status')->default(1);
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
        Schema::drop('452_email_template_meta');
    }
}
