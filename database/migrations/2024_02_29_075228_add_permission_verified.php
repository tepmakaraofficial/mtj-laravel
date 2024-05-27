<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            'name'=>'Verified',
            'display_name'=>'Verified User',
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
        $pid = DB::table('permissions')->insertGetId([
            'key'=>'user_verified',
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=>$pid,
            'role_id'=>$rid
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
