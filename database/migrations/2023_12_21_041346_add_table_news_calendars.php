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
        if(!Schema::hasTable('news_calendars')){
            Schema::create('news_calendars', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('type',50)->index()->comment("can be forex or crypto or stock");
                $table->text('data')->nullable();
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
