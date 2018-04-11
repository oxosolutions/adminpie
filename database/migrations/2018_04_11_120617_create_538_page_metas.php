<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create538PageMetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('538_page_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->string('key');
            $table->text('value');
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
        Schema::drop('538_page_metas');
    }
}
