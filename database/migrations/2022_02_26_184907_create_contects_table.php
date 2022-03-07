<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contects', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('function');
            $table->string('mobile');
            $table->string('visibility');
            $table->string('contect_type');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('contects');
    }
    
}
