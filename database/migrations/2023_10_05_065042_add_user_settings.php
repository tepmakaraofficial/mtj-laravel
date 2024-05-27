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
        if(!Schema::hasTable('user_settings')){
            Schema::create('user_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fk_user')->index();
                $table->string('key',100)->index();
                $table->string('value')->index();
                $table->tinyInteger('status')->index();
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
