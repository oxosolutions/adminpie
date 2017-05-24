<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalOrganizationsMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_organizations_metas', function(Blueprint $table){
            $table->increments('id');
            $table->string('key');
            $table->string('value');
            $table->string('transition')->nullable();
            $table->unsignedInteger('created_by')->index();
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
        Schema::dropIfExist('global_organizations_metas');
    }
}
