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
        if(!Schema::hasTable('likes')){
            Schema::create('likes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('type',15)->index();
                $table->bigInteger('type_id')->index();
                $table->unsignedBigInteger('fk_user')->index();
                $table->tinyInteger('liked')->default(0)->index();           
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
