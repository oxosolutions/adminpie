<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create502Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('502_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('phone')->nullable();
            $table->text('additional_info')->nullable();
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
        Schema::drop('502_clients');
    }
}
