<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_notifications', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('event_id')->unsigned();
            $table->string('subject', 191);
            $table->text('body_text', 600);
            $table->text('body_text2', 600)->nullable();
            $table->text('body_text3', 600)->nullable();
            $table->string('respond_email', 191);
            $table->string('scheduled_date');
            $table->string('scheduled_time');
            $table->string('time_utc')->nullable();
            $table->string('timezone', 191);
            $table->bigInteger('status_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("event_id")->references("id")->on("events");
            $table->foreign("status_id")->references("id")->on("statuses");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_notifications');
    }
}
