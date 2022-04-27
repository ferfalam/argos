<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpvDetailsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spv_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->string('mobile')->nullable();
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('client_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('sub_category_id')->unsigned();
            $table->foreign('sub_category_id')->references('id')->on('client_sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('contacts_id')->unsigned()->nullable();
            $table->foreign('contacts_id')->references('id')->on('contects')->onDelete('cascade')->onUpdate('cascade');            
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('company_t_l_a_s')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->string('language')->nullable();
            $table->tinyInteger('sms_notifications')->nullable();
            $table->tinyInteger('email_notifications')->nullable();
            $table->string('email')->nullable();
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('spv_details');
    }
}
