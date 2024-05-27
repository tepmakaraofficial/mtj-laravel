<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mistakes')){
            Schema::create('mistakes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fk_user')->index();
                $table->string('title',200)->index();
                $table->text('desc')->nullable();
                $table->tinyInteger('level')->index();
                $table->tinyInteger('action')->index();
                $table->timestamps();
                $table->foreign('fk_user')->references('id')->on('users');
            });
        }
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
};
