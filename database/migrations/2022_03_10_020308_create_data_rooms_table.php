<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_rooms', function (Blueprint $table) {
            $table->id();
            $table->string("doc_name");
            $table->string("project_name");
            $table->string("task_name");
            $table->string("visible_by");
            $table->boolean("publish")->default(false);
            $table->dateTime("publish_date")->nullable();
            $table->integer('file_id')->unsigned();
            $table->integer('espace_id')->unsigned();
            $table->foreign('espace_id')->references('id')->on('espaces')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('last_update_user_id')->unsigned();
            $table->foreign('last_update_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('data_rooms');
    }
}
