<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeysFromBookingsQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_student_id_foreign');
        });

        Schema::table('queries', function (Blueprint $table) {
            $table->dropForeign('queries_student_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::table('queries', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students');
        });
    }
}
