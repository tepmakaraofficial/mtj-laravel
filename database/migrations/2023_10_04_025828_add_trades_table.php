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
        if(!Schema::hasTable('accounts')){
            Schema::create('accounts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fk_user')->index();
                $table->string('name',100)->index();
                $table->double('balance')->default(0);
                $table->string('ccy',50)->index();
                $table->text('remark')->nullable();
                $table->tinyInteger('status');
                $table->timestamps();
                $table->foreign('fk_user')->references('id')->on('users');
            });
        }
        if(!Schema::hasTable('trades')){
            Schema::create('trades', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fk_user')->index();
                $table->string('trading_type',50)->index();
                $table->unsignedBigInteger('fk_account')->index();
                $table->string('platform',100)->index();
                $table->string('pair',100)->index();
                $table->string('position',100)->index();
                $table->double('size')->nullable();
                $table->string('strategy')->index()->nullable();
                $table->string('entry_type',50)->index();
                $table->tinyInteger('profit_status')->index()->nullable()->default(0);
                $table->tinyInteger('profit_type')->index()->nullable();
                $table->tinyInteger('emotion_status')->index()->nullable();
                $table->double('profit_amount')->nullable();
                $table->string('session',150)->index()->nullable();
                $table->string('close_position',100)->index()->nullable();
                $table->double('open_price')->nullable();
                $table->double('close_price')->nullable();
                $table->integer('duration_min')->nullable();
                $table->text('remark')->nullable();
                $table->timestamps();
                $table->foreign('fk_user')->references('id')->on('users');
                $table->foreign('fk_account')->references('id')->on('accounts');
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
