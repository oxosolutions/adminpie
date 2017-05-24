<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create10RolePermissons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('10_role_permissons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('permisson_id');
            $table->integer('read')->default(1);
            $table->integer('write')->default(1);
            $table->integer('delete')->default(1);
            $table->integer('other')->default(0);
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
        Schema::drop('10_role_permissons');
    }
}
