<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('rekening_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rekening');
            $table->string('atas_nama');
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekening_transfers');
    }
}

