<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->boolean('personal_team');

            $table->integer('id_pack')->nullable();
            $table->datetime('pack_term')->nullable();
            $table->integer('pack_sms')->nullable();
            $table->integer('pack_email')->nullable();

            $table->boolean('switch_sms')->nullable();
            $table->boolean('switch_email')->nullable();
            $table->integer('sms_clock')->nullable();
            $table->integer('email_clock')->nullable();
            $table->text('sms_text')->nullable();
            $table->text('email_text')->nullable();

            $table->boolean('switch_widget')->nullable();
            $table->boolean('delete_visit_widget')->nullable();
            $table->string('logo_widget')->nullable();
            $table->string('name_widget')->nullable();
            $table->string('url_widget')->nullable();

            $table->string('address_city')->nullable();
            $table->string('address_code')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

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
        Schema::drop('teams');
    }
}
