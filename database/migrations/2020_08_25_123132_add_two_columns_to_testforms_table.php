<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoColumnsToTestformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testforms', function (Blueprint $table) {
            //
            $table->string('date', 191)->after('email');
            $table->string('time', 191)->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testforms', function (Blueprint $table) {
            //
            $table->string('date', 191)->after('email');
            $table->string('time', 191)->after('date');
        });
    }
}
