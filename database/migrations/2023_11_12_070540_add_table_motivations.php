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
        if(!Schema::hasTable('motivations')){
            Schema::create('motivations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->index();
                $table->tinyInteger('type')->index();
                $table->text('content')->nullable();
                $table->tinyInteger('status')->index();
                $table->integer('like')->default(0);               
                $table->timestamps();
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
