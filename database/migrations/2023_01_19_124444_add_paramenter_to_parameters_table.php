<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(env('DB_CONNECTION') == 'sqlsrv')
            DB::unprepared('SET IDENTITY_INSERT automation ON');

        DB::table('users')->insert(
            [
                [
                    'name' => 'Developer',
                    'email' => 'dev@meudoominio.com.br',
                    'password' => "",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]
        );
        if(env('DB_CONNECTION') == 'sqlsrv')
            DB::unprepared('SET IDENTITY_INSERT automation ON');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->whereIn('email', ['dev@meudoominio.com.br',])->delete();
    }
};
