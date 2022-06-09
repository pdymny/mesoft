<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->foreignId('user_id')->index();
            $table->foreignId('worker_id')->index();
            $table->foreignId('patient_id')->index();
            $table->foreignId('service_id')->index();
            $table->foreignId('send_sms_id')->index();
            $table->foreignId('send_email_id')->index();
            $table->datetime('date_visit');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teams_visits');
    }
}
