<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToTransferRekeningToBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening_transfers', function (Blueprint $table) {
            $table->unsignedBigInteger('master_bank_id')->nullable(); // Foreign key to master_bank table
            $table->foreign('master_bank_id')->references('id')->on('master_banks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer_rekening_to_bank', function (Blueprint $table) {
            //
        });
    }
}
