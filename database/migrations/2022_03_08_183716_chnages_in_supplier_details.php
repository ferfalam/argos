<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChnagesInSupplierDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_details', function (Blueprint $table) {
            $table->bigInteger('contacts_id')->unsigned()->nullable();
            $table->foreign('contacts_id')->references('id')->on('contects')->onDelete('cascade')->onUpdate('cascade');            
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('company_t_l_a_s')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->string('language')->nullable();
            $table->tinyInteger('sms_notifications')->nullable();
            $table->tinyInteger('email_notifications')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_details', function (Blueprint $table) {
            //
        });
    }
}
