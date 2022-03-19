<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpvCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spv_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->timestamps();
        });
        Schema::create('spv_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('spv_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('category_name');
            $table->timestamps();
        });
        Schema::table('spv_details', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->unsignedBigInteger('category_id')->nullable()->default(null)->change();
            $table->foreign('category_id')->references('id')->on('spv_categories')->onDelete('cascade')->onUpdate('cascade')->change();
            $table->unsignedBigInteger('sub_category_id')->nullable()->default(null)->change();
            $table->foreign('sub_category_id')->references('id')->on('spv_sub_categories')->onDelete('cascade')->onUpdate('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spv_details', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('sub_category_id');
        });
        Schema::dropIfExists('spv_sub_categories');
        Schema::dropIfExists('spv_categories');
    }
}
