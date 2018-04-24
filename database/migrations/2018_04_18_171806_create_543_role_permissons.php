<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create543RolePermissons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('543_role_permissons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->string('permisson_type');
            $table->integer('permisson_id');
            $table->string('permisson')->nullable();
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
        Schema::drop('543_role_permissons');
    }
}
