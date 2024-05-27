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
        $rid = DB::table('roles')->insertGetId([
            'name'=>'trader',
            'display_name'=>'Trader',
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
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
