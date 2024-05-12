<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUcapansTable extends Migration
{
    public function up()
    {
        Schema::create('ucapans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('ucapan');
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ucapans');
    }
}
