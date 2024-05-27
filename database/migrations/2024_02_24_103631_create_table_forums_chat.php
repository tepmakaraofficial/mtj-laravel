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
        if(!Schema::hasTable('forums_chats')){
            Schema::create('forums_chats', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('post')->fullText()->nullable();
                $table->unsignedBigInteger('fk_cat')->index()->nullable();
                $table->unsignedBigInteger('parent_id')->index()->nullable();
                $table->unsignedBigInteger('fk_user')->index()->nullable();
                $table->timestamps();
                $table->tinyInteger('status')->default(1);
                $table->index('created_at');
                $table->foreign('fk_cat')->references('id')->on('forums_categories');
                $table->foreign('fk_user')->references('id')->on('users');
                $table->foreign('parent_id')->references('id')->on('forums_chats');
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
        Schema::dropIfExists('table_forums_chat');
    }
};
