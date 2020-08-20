<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateNullableColumnsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {

            $table->string('date', 191)->after('inst_id');
            $table->string('start_time', 191)->after('date');
            $table->string('end_time', 191)->after('start_time');
            $table->string('start_utc', 191)->after('end_time');
            $table->string('end_utc', 191)->after('start_utc');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            
            $table->string('date', 191)->after('inst_id');
            $table->string('start_time', 191)->after('date');
            $table->string('end_time', 191)->after('start_time');
            $table->string('start_utc', 191)->after('end_time');
            $table->string('end_utc', 191)->after('start_utc');

            
        });
    }
}
