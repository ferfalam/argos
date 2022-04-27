<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->timestamps();
        });
        Schema::create('supplier_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('supplier_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('category_name');
            $table->timestamps();
        });
        Schema::table('supplier_details', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->unsignedBigInteger('category_id')->nullable()->default(null)->change();
            $table->foreign('category_id')->references('id')->on('supplier_categories')->onDelete('cascade')->onUpdate('cascade')->change();
            $table->unsignedBigInteger('sub_category_id')->nullable()->default(null)->change();
            $table->foreign('sub_category_id')->references('id')->on('supplier_sub_categories')->onDelete('cascade')->onUpdate('cascade')->change();
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
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('sub_category_id');
        });
        Schema::dropIfExists('supplier_sub_categories');
        Schema::dropIfExists('supplier_categories');
    }
}
