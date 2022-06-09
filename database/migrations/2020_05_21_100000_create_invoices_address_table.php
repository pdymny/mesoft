<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->string('name');
            $table->string('nip');
            $table->string('regon');
            $table->string('code');
            $table->string('city');
            $table->string('street');
            $table->string('number');
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
        Schema::drop('invoices_address');
    }
}
