<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_pages', function(Blueprint $table){

            $table->increments('id');
            $table->string('page_title');
            $table->string('page_slug');
            $table->text('content');
            $table->string('page_image')->nullable();
            $table->integer('status');
            $table->unsignedInteger('created_by')->index();
            $table->softDeletes();
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
        Schema::dropIfExists('global_pages');
    }
}
