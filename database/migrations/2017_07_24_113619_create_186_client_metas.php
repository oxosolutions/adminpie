<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create186ClientMetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('186_client_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string ('key');
            $table->text('value');
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
        Schema::drop('186_client_metas');
    }
}
