<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->index();
            $table->text('name');
            $table->integer('unity');
            $table->integer('pieces');
            $table->integer('sum');
            $table->text('settings');
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
        Schema::drop('invoices_records');
    }
}
