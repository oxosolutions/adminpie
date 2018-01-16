<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create435MediaMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('435_media_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('media_id');
            $table->string('key');
            $table->text('value')->nullable();
            $table->string('type')->nullable();
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
        Schema::drop('435_media_meta');
    }
}
