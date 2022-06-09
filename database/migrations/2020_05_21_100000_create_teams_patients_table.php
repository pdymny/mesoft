<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->string('firstname');
            $table->string('name');
            $table->string('email');
            $table->string('pesel')->nullable();
            $table->date('birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('address_number')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_code')->nullable();
            $table->string('address_city')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('teams_patients');
    }
}
