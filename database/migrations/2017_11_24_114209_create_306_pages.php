<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create306Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('306_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->text('tags')->nullable();
            $table->string('categories')->nullable();
            $table->string('post_type')->nullable();
            $table->string('attachments')->nullable();
            $table->string('version')->nullable();
            $table->string('revision')->nullable();
            $table->string('created_by')->nullable();
            $table->string('post_status')->nullable();
            $table->integer('status')->default(1);
            $table->string('type');
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
        Schema::drop('306_pages');
    }
}
