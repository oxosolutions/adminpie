<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create264WidgetPermissons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('264_widget_permissons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('widget_id')->nullable();
            $table->string('permisson')->nullable();
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
        Schema::drop('264_widget_permissons');
    }
}
