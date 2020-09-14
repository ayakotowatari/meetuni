<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_type_id')->unsigned();
            $table->string('first_name',191);
            $table->string('last_name',191);
            $table->string('email',191);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('year_id')->unsigned();
            $table->integer('life');
            $table->string('remember_token',100);
            $table->timestamps();
            $table->softDeletes();
            $table->unique('email');
            
            $table->foreign("user_type_id")->references("id")->on("user_types");
            $table->foreign("country_id")->references("id")->on("countries");
            $table->foreign("year_id")->references("id")->on("years");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
