<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTechnologyIdToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // $table->integer('place_id')->unsigned()->default(1);
            // $table->foreign('place_id')->references('id')->on('project_places')->onDelete('cascade')->onUpdate('cascade');

            $table->Integer('place_id')->unsigned()->nullable();
            $table->foreign('place_id')->references('id')->on('project_places')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
}
