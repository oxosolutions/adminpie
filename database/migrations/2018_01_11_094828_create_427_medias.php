<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create427Medias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('427_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('title');
            $table->string('slug');
            $table->string('original_name')->nullable();
            $table->string('type')->nullable();
            $table->string('extension')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('dimension')->nullable();
            $table->string('size')->nullable();
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
        Schema::drop('427_medias');
    }
}
