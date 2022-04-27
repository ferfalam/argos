<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->Integer('client_detail_id')->unsigned()->nullable();
            $table->foreign('client_detail_id')->references('id')->on('client_details')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('supplier_detail_id')->unsigned()->nullable();
            $table->foreign('supplier_detail_id')->references('id')->on('supplier_details')->onDelete('cascade')->onUpdate('cascade');
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
