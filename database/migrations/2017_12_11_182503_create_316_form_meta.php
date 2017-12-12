<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create316FormMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('316_form_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->string('key');
            $table->text('value')->nullable();
            $table->string('type');
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
        Schema::drop('316_form_meta');
    }
}
