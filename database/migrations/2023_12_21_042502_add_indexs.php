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
        Schema::table('news_calendars', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::table('motivations', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::table('mistakes', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('updated_at');
            $table->fullText('desc');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->index('created_at');
        });
        Schema::table('user_settings', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('position');
        });
        Schema::table('trades', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('updated_at');
            $table->fullText('remark');
        });
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
