<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsOfStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->bigInteger('country_id')->unsigned()->nullable()->change();
            $table->bigInteger('year_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            
            $table->bigInteger('country_id')->unsigned()->nullable(false)->change();
            $table->bigInteger('year_id')->unsigned()->nullable(false)->change();
        });
    }
}
