<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->comment('Super Admin');
            $table->bigInteger('inst_id')->unsigned();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191)->unique();
            $table->string('job_title', 191);
            $table->string('department', 191);
            $table->string('token', 20)->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("inst_id")->references("id")->on("insts");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
