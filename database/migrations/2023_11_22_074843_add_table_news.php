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
        if(!Schema::hasTable('news')){
            Schema::create('news', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('category',50)->index();
                $table->string('headline')->index();
                $table->bigInteger('news_id')->index();
                $table->timestamp('news_date')->nullable();
                $table->string('image')->nullable();
                $table->string('related')->nullable();
                $table->string('source')->nullable()->index();
                $table->text('summary')->nullable();
                $table->text('url')->nullable(); 
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
