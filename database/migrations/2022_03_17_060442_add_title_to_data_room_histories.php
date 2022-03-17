<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToDataRoomHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_room_histories', function (Blueprint $table) {
            $table->bigInteger('data_room_id')->unsigned()->nullable()->change();


            $table->string('title')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_room_histories', function (Blueprint $table) {
            //
        });
    }
}
