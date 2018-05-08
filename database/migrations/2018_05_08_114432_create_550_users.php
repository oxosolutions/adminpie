<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create550Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('550_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('user_type')->nullable();
            $table->integer('status')->default(1);
            $table->integer('deleted_at')->default(0);
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
        Schema::drop('550_users');
    }
}
