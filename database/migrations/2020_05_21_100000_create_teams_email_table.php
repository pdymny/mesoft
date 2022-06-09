<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_email', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->foreignId('visit_id')->index();
            $table->foreignId('patient_id')->index();
            $table->datetime('date_send');
            $table->integer('status');
            $table->text('message');
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
        Schema::drop('teams_email');
    }
}
