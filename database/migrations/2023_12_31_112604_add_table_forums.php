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
        if(!Schema::hasTable('forums_categories')){
            Schema::create('forums_categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('tag',50)->index()->nullable();
                $table->string('title',100)->index();
                $table->string('desc')->fullText()->nullable();
                $table->tinyInteger('status')->default(1);
                $table->tinyInteger('position')->nullable();
                $table->unsignedBigInteger('parent_id')->index()->nullable();
                $table->timestamps();
                $table->index('created_at');
                $table->foreign('parent_id')->references('id')->on('forums_categories');
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
