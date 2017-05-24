<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create10Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('10_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('tags')->nullable();
            $table->string('categories')->nullable();
            $table->string('post_type')->nullable();
            $table->string('attachments')->nullable();
            $table->string('version')->nullable();
            $table->string('revision')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('  status')->default(1);
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
        Schema::drop('10_pages');
    }
}
