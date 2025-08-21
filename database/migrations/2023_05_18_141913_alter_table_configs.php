<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        /* alter filed value for bigtext table configs */
        Schema::table('configs', function($table) {
            $table->longText('value')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* alter filed value for string table configs */
        Schema::table('configs', function($table) {
            $table->string('value')->nullable()->change();
        });

    }
};
