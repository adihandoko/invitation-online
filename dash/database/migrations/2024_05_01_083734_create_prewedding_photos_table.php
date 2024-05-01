<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreweddingPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('prewedding_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->string('photo_path');
            // Tambahkan kolom lain sesuai kebutuhan, misalnya deskripsi, tipe foto, dll.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prewedding_photos');
    }
}
