<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create536DatasetMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('536_dataset_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dataset_id');
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
        Schema::drop('536_dataset_meta');
    }
}
