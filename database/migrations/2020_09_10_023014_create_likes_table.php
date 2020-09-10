<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
           
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('event_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('student_id');
            $table->index('event_id');

            $table->unique([
                'student_id',
                'event_id'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
