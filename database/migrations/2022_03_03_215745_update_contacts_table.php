<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_details', function (Blueprint $table) {
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('company_t_l_a_s')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->string('language')->nullable();
            $table->tinyInteger('sms_notifications')->nullable();
            // $table->integer('user_id')->nullable()->change(); change user_id to allow null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
